<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa baner</title>
</head>
<body>
    <h1>Chỉnh sửa baner</h1>
    <form action="{{ route('updatebaner', $baner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="baner">Ảnh Baner:</label><br>
        <img id="preview_image" src="{{ asset('baner1/' . $baner->baner) }}" alt="Baner Image" style="max-width: 200px;"><br>
        <input type="file" name="baner_image" id="baner_image" onchange="previewImage();">
        <br>
        <label for="link">Link:</label>
        <input type="text" name="link" value="{{ $baner->link }}">
        <br>
        <button type="submit">Cập nhật</button>
    </form>
    <script>
        function previewImage() {
            var input = document.getElementById('baner_image');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview_image').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>