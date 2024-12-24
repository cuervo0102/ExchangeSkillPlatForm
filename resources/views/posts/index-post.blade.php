<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #93C54B, #2E7D32);
            min-height: 100vh;
            padding: 20px;
        }

        .posts-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .post-card {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .post-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .post-content {
            padding: 1.5rem;
        }

        .post-title {
            color: #2E7D32;
            margin-bottom: 1rem;
        }

        .interest-badge {
            background: linear-gradient(to right, #93C54B, #2E7D32);
            color: white;
            border-radius: 15px;
            padding: 5px 15px;
            margin-right: 5px;
            margin-bottom: 5px;
            display: inline-block;
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
    <div class="posts-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-white">Posts</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-custom">Create New Post</a>
        </div>

        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-6 col-lg-4">
                    <div class="post-card">
                        <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}" class="post-image">
                        <div class="post-content">
                            <h3 class="post-title">{{ $post->title }}</h3>
                            <p>{{ Str::limit($post->content, 150) }}</p>
                            
                            <div class="mb-3">
                                @foreach($post->interests as $interest)
                                    <span class="interest-badge">{{ $interest->interest }}</span>
                                @endforeach
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">By {{ $post->user->name }}</small>
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-custom btn-sm">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</body>
</html>