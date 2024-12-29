<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 2rem;
            max-width: 800px;
            margin: 2rem auto;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .profile-picture-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 1rem;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
            border: 3px solid #f8f9fa;
        }

        .camera-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #93C54B;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: white;
            transition: all 0.3s ease;
            border: 3px solid white;
        }

        .camera-icon:hover {
            background: #7aa840;
            transform: scale(1.1);
        }

        .btn-save, .btn-delete {
            border-radius: 25px;
            padding: 0.75rem 2rem;
            transition: all 0.3s ease;
        }

        .btn-save {
            background: #93C54B;
            color: white;
        }

        .btn-save:hover {
            background: #7aa840;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background: #bb2d3b;
            transform: translateY(-2px);
        }

        .delete-section {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #dee2e6;
        }

        .modal-content {
            border-radius: 15px;
        }

        .alert {
            border-radius: 15px;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="profile-card">
            <div class="profile-header">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    
                    <div class="profile-picture-container">
                        <img id="preview-image" 
                             src="{{ auth()->user()->profile_picture_url 
                                  ? Storage::url(auth()->user()->profile_picture_url) 
                                  : asset('/public/images/default.webp') }}" 
                             alt="Profile Picture" 
                             class="profile-picture">
                        <label for="profile_picture" class="camera-icon">
                            <i class="bi bi-camera-fill"></i>
                        </label>
                        <input type="file" 
                               id="profile_picture" 
                               name="profile_picture" 
                               class="d-none" 
                               accept="image/*"
                               onchange="previewImage(this);">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" 
                                       class="form-control @error('first_name') is-invalid @enderror" 
                                       name="first_name" 
                                       value="{{ old('first_name', auth()->user()->first_name) }}" 
                                       required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" 
                                       class="form-control @error('last_name') is-invalid @enderror" 
                                       name="last_name" 
                                       value="{{ old('last_name', auth()->user()->last_name) }}" 
                                       required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>



                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" 
                                       class="form-control" 
                                       value="{{ auth()->user()->email }}" 
                                       disabled>
                                <small class="text-muted">Email cannot be changed</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Age</label>
                                <input type="number" 
                                       class="form-control @error('age') is-invalid @enderror" 
                                       name="age" 
                                       value="{{ old('age', auth()->user()->age) }}" 
                                       required>
                                @error('age')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Date of Entry</label>
                                <input type="date" 
                                       class="form-control @error('date_of_entry') is-invalid @enderror" 
                                       name="date_of_entry" 
                                       value="{{ old('date_of_entry', auth()->user()->date_of_entry) }}" 
                                       required>
                                @error('date_of_entry')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="student_year" class="form-label">Year of Study</label>
                                <select id="student_year" name="student_year" class="form-select @error('student_year') is-invalid @enderror" required>
                                    <option value="1st Year" @selected(old('student_year') == '1st Year')>1st Year</option>
                                    <option value="2nd Year" @selected(old('student_year') == '2nd Year')>2nd Year</option>
                                    <option value="3rd Year" @selected(old('student_year') == '3rd Year')>3rd Year</option>
                                    <option value="4th Year" @selected(old('student_year') == '4th Year')>4th Year</option>
                                    <option value="5th Year" @selected(old('student_year') == '5th Year')>5th Year</option>
                                </select>
                                @error('student_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field" class="form-label">Field</label>
                                <select id="field" name="field" class="form-select @error('field') is-invalid @enderror" required>
                                    <option value="Genie Civil" @selected(old('field') == 'Genie Civil')>Genie Civil</option>
                                    <option value="Genie Informatique" @selected(old('field') == 'Genie Informatique')>Genie Informatique</option>
                                    <option value="Genie Industriel" @selected(old('field') == 'Genie Industriel')>Genie Industriel</option>
                                    <option value="Prepa First Year" @selected(old('field') == 'Prepa First Year')>Prepa First Year</option>
                                    <option value="Prepa Second Year" @selected(old('field') == 'Prepa Second Year')>Prepa Second Year</option>
                                </select>
                                @error('field')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
    

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-save">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <!-- Delete Account Section -->
            <div class="delete-section">
                <h3 class="text-danger mb-4">Delete Account</h3>
                <p class="text-muted mb-4">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                <button type="button" class="btn btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    Delete Account
                </button>
            </div>
        </div>

        <!-- Delete Account Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="deleteModalLabel">Delete Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       name="password" 
                                       placeholder="Enter your password to confirm" 
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-delete">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

