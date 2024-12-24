<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Interests</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #93C54B, #2E7D32);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 600px;
        }

        .form-title {
            color: #2E7D32;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2rem;
        }

        .form-label {
            color: #2E7D32;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-select {
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 0.75rem;
            margin-bottom: 1rem;
        }

        .form-select:focus {
            border-color: #93C54B;
            box-shadow: 0 0 0 0.2rem rgba(147, 197, 75, 0.25);
        }

        .btn-custom {
            background: linear-gradient(to right, #93C54B, #2E7D32);
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            width: 100%;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 125, 50, 0.3);
        }

        select[multiple] {
            height: 200px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="form-title">Student Interests</h2>
        <form action="" method="POST">
            @csrf
            <div class="mb-4">
                <label for="field" class="form-label">Select Your Field:</label>
                <select id="field" name="field" class="form-select" required>
                    <option value="" disabled selected>Select your field</option>
                    <option value="Genie Civil">Genie Civil</option>
                    <option value="Genie Informatique">Genie Informatique</option>
                    <option value="Genie Industriel">Genie Industriel</option>
                    <option value="Prepa First Year">Prepa First Year</option>
                    <option value="Prepa Second Year">Prepa Second Year</option>
                </select>
            </div>
            
            <div class="mb-4" id="interests-container" style="display: none;">
                <label for="interests" class="form-label">Select Your Interests:</label>
                <select id="interests" name="interests[]" class="form-select" multiple>
                    <!-- Interests will be dynamically loaded here -->
                </select>
            </div>
            
            <button type="submit" class="btn btn-custom">Save Interests</button>
        </form>
    </div>

    <script>
        document.getElementById('field').addEventListener('change', function () {
            const field = this.value;
            const interestsContainer = document.getElementById('interests-container');
            const interestsSelect = document.getElementById('interests');

            interestsSelect.innerHTML = '';

            if (field) {
                fetch(`/interests/${field}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.length) {
                            data.forEach(interest => {
                                const option = document.createElement('option');
                                option.value = interest.id;
                                option.textContent = interest.interest;
                                interestsSelect.appendChild(option);
                            });
                            interestsContainer.style.display = 'block';
                        } else {
                            interestsContainer.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching interests:', error);
                    });
            } else {
                interestsContainer.style.display = 'none';
            }
        });
    </script>
</body>
</html>