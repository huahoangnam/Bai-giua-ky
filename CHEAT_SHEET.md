# CHƯƠNG 4 - CHEAT SHEET (Tóm Tắt Nhanh)

## 🎯 Models & Relationships

### Classroom Model
```php
$classroom = Classroom::find(1);
$students = $classroom->students; // Get all students
```

### Student Model
```php
// Get student with relationships
$student = Student::find(5);
$classroom = $student->classroom;
$subjects = $student->subjects;

// Get active students (Local Scope)
$activeStudents = Student::active()->get();

// Already sorted by name (Global Scope)
```

### Subject Model
```php
$subject = Subject::find(3);
$students = $subject->students; // Get all students
```

---

## 📊 Quick Queries (QueryExamples Service)

```php
use App\Services\QueryExamples;

// 1. Students in a class
QueryExamples::getStudentsByClassName('CNTT1');

// 2. Subjects for a student
QueryExamples::getSubjectsByStudentId(5);

// 3. Count students per class
QueryExamples::countStudentsByClass();

// 4. Students with subject count
QueryExamples::getStudentsWithSubjectCount();

// Bonus queries
QueryExamples::getActiveStudentsWithDetails();
QueryExamples::getStudentsWithSubjectsByClassName('CNTT1');
QueryExamples::getSubjectsWithStudentCount();
QueryExamples::getPassedStudentsBySubject(3); // score >= 5
```

---

## 🏛️ Repository Pattern Methods

```php
use App\Repositories\Contracts\StudentRepositoryInterface;

// Inject via constructor or container
$repository = app(StudentRepositoryInterface::class);

// CRUD Operations
$students = $repository->all();                           // Get all
$student = $repository->find(5);                          // Get one
$students = $repository->studentsByClass(1);              // Get by class
$students = $repository->activeStudents();                // Get active

$student = $repository->create([...]);                    // Create
$success = $repository->update(5, [...]);                 // Update
$success = $repository->delete(5);                        // Delete

// Subject Registration
$success = $repository->registerSubject(5, 3, ['score' => 8.5]);
$success = $repository->unregisterSubject(5, 3);
```

---

## 🔄 Relationship Methods

### Eager Loading (Prevent N+1)
```php
// With relationships
Student::with('classroom', 'subjects')->get();
Student::with('classroom')->with('subjects')->get();

// Nested relationships
Classroom::with('students.subjects')->get();

// Lazy eager loading
$students = Student::all();
$students->load('classroom', 'subjects');
```

### Working with Pivot
```php
$student = Student::find(5);

// Get pivot data
foreach ($student->subjects as $subject) {
    $score = $subject->pivot->score;
    $registeredAt = $subject->pivot->registered_at;
}

// Add/Update/Remove
$student->subjects()->attach(3, ['score' => 8.5]);
$student->subjects()->updateExistingPivot(3, ['score' => 9.0]);
$student->subjects()->detach(3);
$student->subjects()->sync([1, 2, 3]); // Replace all
```

---

## 🌐 REST API Endpoints

### Endpoint Summary
```
GET    /api/students                              # List all
POST   /api/students                              # Create
GET    /api/students/{id}                         # Get one
PUT    /api/students/{id}                         # Update
DELETE /api/students/{id}                         # Delete

GET    /api/students/{id}/subjects                # List subjects
POST   /api/students/{id}/register-subject/{sid}  # Register
DELETE /api/students/{id}/unregister-subject/{sid}# Unregister
```

### Example cURL Commands

#### Get all students
```bash
curl -X GET http://localhost:8000/api/students
```

#### Create student
```bash
curl -X POST http://localhost:8000/api/students \
  -H "Content-Type: application/json" \
  -d '{
    "student_name": "Nguyễn Văn A",
    "class_id": 1,
    "is_active": true
  }'
```

#### Get specific student
```bash
curl -X GET http://localhost:8000/api/students/5
```

#### Update student
```bash
curl -X PUT http://localhost:8000/api/students/5 \
  -H "Content-Type: application/json" \
  -d '{"is_active": false}'
```

#### Delete student
```bash
curl -X DELETE http://localhost:8000/api/students/5
```

#### Get student's subjects
```bash
curl -X GET http://localhost:8000/api/students/5/subjects
```

#### Register for subject
```bash
curl -X POST http://localhost:8000/api/students/5/register-subject/3 \
  -H "Content-Type: application/json" \
  -d '{"score": 8.5}'
```

#### Unregister from subject
```bash
curl -X DELETE http://localhost:8000/api/students/5/unregister-subject/3
```

---

## 🔍 Scopes

### Local Scope: Active Students
```php
// Get active students (is_active = true)
Student::active()->get();

// Chain with other queries
Student::active()->where('class_id', 1)->get();
```

### Global Scope: Sort by Name
```php
// Automatically ordered by student_name (ASC)
Student::all(); // Returns sorted by name

// Bypass global scope if needed
Student::withoutGlobalScopes()->get();
```

---

## 🗂️ File Locations Quick Map

| What | Where |
|------|-------|
| Migrations | `database/migrations/2025_04_17_*` |
| Models | `app/Models/{Classroom, Student, Subject}.php` |
| Scopes | `app/Models/Scopes/SortByNameScope.php` |
| Queries | `app/Services/QueryExamples.php` |
| Repository Interface | `app/Repositories/Contracts/StudentRepositoryInterface.php` |
| Repository Class | `app/Repositories/StudentRepository.php` |
| API Controller | `app/Http/Controllers/StudentApiController.php` |
| API Routes | `routes/api.php` |
| Binding | `app/Providers/AppServiceProvider.php` |

---

## ⚡ Common Tasks

### Task: List all students in class "CNTT1"
```php
// Method 1: Using query
Student::whereHas('classroom', function ($q) {
    $q->where('class_name', 'CNTT1');
})->get();

// Method 2: Using repository
$repository->studentsByClass(1); // Need classroom id

// Method 3: Using QueryExamples
QueryExamples::getStudentsByClassName('CNTT1');
```

### Task: Register student for multiple subjects
```php
$studentId = 5;
$repository = app(StudentRepositoryInterface::class);

$repository->registerSubject($studentId, 1, ['score' => 8.0]);
$repository->registerSubject($studentId, 2, ['score' => 8.5]);
$repository->registerSubject($studentId, 3, ['score' => 9.0]);
```

### Task: Get active students with their classrooms
```php
Student::active()
    ->with('classroom')
    ->get();

// Or with repository
$repository->activeStudents(); // Already loads relationships
```

### Task: Find students who passed a subject
```php
QueryExamples::getPassedStudentsBySubject(3); // score >= 5
```

### Task: Count subjects per student
```php
$students = QueryExamples::getStudentsWithSubjectCount();
// Each student has 'subject_count' attribute
```

---

## 🛠️ Useful Artisan Commands

```bash
# Database
php artisan migrate              # Run migrations
php artisan migrate:fresh        # Reset and run
php artisan migrate:fresh --seed # Reset and seed

# Cache & Config
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Routes
php artisan route:list           # All routes
php artisan route:list --name=api # Only API routes

# Tinker (Interactive PHP)
php artisan tinker

# In tinker, you can test:
>>> $students = Student::all();
>>> $student = Student::find(5);
>>> $student->classroom;
>>> $student->subjects;
```

---

## 📋 Response Formats

### Success Response (200, 201)
```json
{
    "success": true,
    "message": "...",
    "data": {...}
}
```

### Error Response
```json
{
    "success": false,
    "message": "...",
    "error": "..." 
}
```

### Validation Error (422)
```json
{
    "success": false,
    "message": "Validation failed",
    "errors": {
        "student_name": ["The student name field is required"],
        "class_id": ["The class id must be a valid classroom"]
    }
}
```

---

## 🔐 HTTP Status Codes Used

| Code | Meaning | Example |
|------|---------|---------|
| 200 | OK | GET successful |
| 201 | Created | POST successful |
| 400 | Bad Request | Invalid data or already exists |
| 404 | Not Found | Resource not found |
| 422 | Unprocessable Entity | Validation failed |
| 500 | Server Error | Database error |

---

## 💡 Pro Tips

1. **Always use relationships** instead of separate queries to avoid N+1
   ```php
   // ❌ Bad: N+1 queries
   $students = Student::all();
   foreach ($students as $s) { $s->classroom; }
   
   // ✅ Good: One query
   $students = Student::with('classroom')->get();
   ```

2. **Use Repository Pattern** in controllers for clean code
   ```php
   class StudentController {
       public function __construct(StudentRepositoryInterface $repo) {
           $this->repo = $repo;
       }
   }
   ```

3. **Always validate API input**
   ```php
   $request->validate([
       'student_name' => 'required|string|max:255',
       'class_id' => 'required|integer|exists:classrooms,id',
   ]);
   ```

4. **Use eager loading** in repository methods
   ```php
   public function all(): Collection {
       return $this->model->with('classroom', 'subjects')->get();
   }
   ```

5. **Leverage global scope** for consistent ordering
   ```php
   // No need to orderBy('student_name') everywhere
   // Global scope handles it automatically
   ```

---

## 📚 Documentation Files

- **Full Documentation**: `CHAPTER_4_DOCUMENTATION.md`
- **Practical Examples**: `PRACTICAL_EXAMPLES.php`
- **This File**: `CHEAT_SHEET.md`

---

Last Updated: 2025-04-17
