<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Import File</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-1">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Import File</h5>
        </div>
        <div class="card-body p-3">
            <div class="feedback-success">
                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @elseif(session('credentialError'))
                    <div class="alert alert-danger mt-3">
                        {{ session('credentialError') }}
                    </div>
                @endif
            </div>
           <div class="row g-4">
                <div class="col-md-6 offset-md-6 text-end">
                    <a href="{{ route('list') }}" class="btn btn-info">List</a>
                    <a href="{{ route('form') }}" class="btn btn-info">Add</a>
                </div>
            </div>
            <form action="{{ route('import.file') }}" class="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6 offset-md-2">
                        <label class="mb-2">Import File</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" id="file">
                        @error('file')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 offset-md-7">
                        <button class="btn btn-secondary" type="submit">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
