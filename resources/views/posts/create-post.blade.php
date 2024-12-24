<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #93C54B, #2E7D32);
            min-height: 100vh;
            padding: 20px;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin: 2rem auto;
            max-width: 800px;
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

        select[multiple] {
            height: 150px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="form-title">Create New Post</h2>
        
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
            
            {{-- <div class="mb-3">
                <label for="interests" class="form-label">Related Interests</label>
                <select id="interests" name="interests[]" class="form-select" multiple required>
                    @foreach($interests as $interest)
                        <option value="{{ $interest->id }}">{{ $interest->interest }}</option>
                    @endforeach
                </select>
            </div> --}}
            
            <div class="text-center">
                <button type="submit" class="btn btn-custom">Create Post</button>
            </div>
        </form>
    </div>
</body>
</html>

