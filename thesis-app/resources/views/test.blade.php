<!doctype html>
<html>
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <h1>Test page</h1>
  <script>
    fetch('/api/user', {
      method: 'GET',
      credentials: 'include',
      headers: {
        'Accept': 'application/json'
      }
    })
    .then(r => r.json())
    .then(console.log)
    .catch(console.error);
  </script>
</body>
</html>
