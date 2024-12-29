<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #93C54B, #2E7D32);
            min-height: 100vh;
            padding-top: 56px;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .posts-container {
            max-width: 800px;
            margin: 20px auto;
        }

        .post-card {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .post-header {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .post-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .post-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
        }

        .post-content {
            padding: 1.5rem;
        }

        .post-title {
            color: #2E7D32;
            margin-bottom: 1rem;
        }

        .post-actions {
            padding: 0.5rem 1.5rem;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }

        .action-button {
            background: none;
            border: none;
            color: #666;
            padding: 0.5rem 1rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .action-button:hover {
            color: #2E7D32;
        }

        .comments-section {
            padding: 1rem 1.5rem;
        }

        .comment {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }

        .comment-input {
            border-radius: 20px;
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
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
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">EmsisteForm</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/profile')}}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Messages</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search">
                    <button class="btn btn-custom" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="posts-container">
        <!-- Create Post Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-white">Posts</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-custom">Create New Post</a>
        </div>

        <!-- Posts -->
        @foreach($posts as $post)
        <div class="post-card">
            <!-- Post Header -->
            <div class="post-header d-flex align-items-center">
                <img src="{{ Storage::url($post->user->profile_picture) }}" alt="User Avatar" class="post-user-avatar me-3">
                <div>
                    <h6 class="mb-0">{{ $post->user->name }}</h6>
                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                </div>
            </div>

            @if($post->image_path)
                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="post-image">
            @else
                <div class="no-image-placeholder">
                    <i class="fas fa-image"></i>
                </div>
            @endif

            <!-- Post Content -->
            <div class="post-content">
                <h3 class="post-title">{{ $post->title }}</h3>
                <p>{{ Str::limit($post->content, 150) }}</p>
            </div>

            <!-- Post Actions -->
            <div class="post-actions d-flex justify-content-between">
                <button class="action-button">
                    <i class="fas fa-thumbs-up"></i> Like
                </button>
                <button class="action-button">
                    <i class="fas fa-comment"></i> Comment
                </button>
                <button class="action-button">
                    <i class="fas fa-share"></i> Share
                </button>
            </div>

            <!-- Comments Section -->
            <div class="comments-section">
                <!-- Existing Comments -->
                {{-- @foreach($post->comments as $comment)
                <div class="comment">
                    <div class="d-flex">
                        <img src="{{ Storage::url($comment->user->avatar) }}" alt="User Avatar" class="post-user-avatar me-2" style="width: 32px; height: 32px;">
                        <div>
                            <h6 class="mb-1">{{ $comment->user->name }}</h6>
                            <p class="mb-1">{{ $comment->content }}</p>
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
                @endforeach --}}

                <!-- Comment Input -->
                <div class="d-flex mt-3">
                    <input type="text" class="form-control comment-input" placeholder="Write a comment...">
                    <button class="btn btn-custom ms-2">Post</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>