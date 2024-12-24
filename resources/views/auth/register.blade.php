<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">


<style>

body {
    background: linear-gradient(135deg, #93C54B, #2E7D32);
    min-height: 100vh;
}

.form-container {
    background-color: rgba(255, 255, 255, 0.95);
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    margin: 2rem auto;
    max-width: 600px;
}

.form-label {
    color: #2E7D32;
    font-weight: 500;
}

.form-control:focus, .form-select:focus {
    border-color: #93C54B;
    box-shadow: 0 0 0 0.2rem rgba(147, 197, 75, 0.25);
}

.btn-custom {
    background: linear-gradient(to right, #93C54B, #2E7D32);
    border: none;
    color: white;
    padding: 10px 25px;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.btn-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(46, 125, 50, 0.3);
}

.logo-container {
    text-align: center;
    margin-bottom: 2rem;
}

.login-link {
    color: #2E7D32;
    text-decoration: none;
    transition: all 0.3s ease;
}

.login-link:hover {
    color: #93C54B;
}


    </style>
</head>
<body>
    <div class="container py-5">
        <div class="form-container">
            <div class="logo-container">
                <h2 class="text-success mb-4">Student Registration</h2>
            </div>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input id="first_name" name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input id="last_name" name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input id="age" name="age" type="number" class="form-control @error('age') is-invalid @enderror" value="{{ old('age') }}" required>
                            @error('age')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_of_entry" class="form-label">Date of Entry</label>
                            <input id="date_of_entry" name="date_of_entry" type="date" class="form-control @error('date_of_entry') is-invalid @enderror" value="{{ old('date_of_entry') }}" required>
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

                <div class="mb-3">
                    <label for="email" class="form-label">EMSI Email</label>
                    <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="format@emsi-edu.ma" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" required>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a class="login-link" href="{{ route('login') }}">Already registered?</a>
                    <button type="submit" class="btn btn-custom">Register</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
