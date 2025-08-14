<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Unity Game</title>

    <script>
        window.currentUser = {
            id: "{{ auth()->id() }}"
        };
    </script>

</head>

<body>
    <iframe src="{{ asset('webgl-2/index.html') }}" width="1920" height="1080"
        sandbox="allow-scripts allow-same-origin allow-forms">
    </iframe>

    <script>
        window.currentUser = {
            id: "{{ auth()->id() }}"
        };

        window.__unitySaveScore = async function (score) {
            console.log("🎯 Sending score:", score, "for user ID:", window.currentUser.id);

            const res = await fetch("/scores", {
                method: "POST",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]').content
                },
                body: JSON.stringify({
                    score: score,
                    user_id: window.currentUser.id
                })
            });

            const text = await res.text();
            try {
                const json = JSON.parse(text);
                console.log("✅ Saved:", json);
            } catch (e) {
                console.error("❌ Response was not JSON:", text);
            }
        };
    </script>
</body>

</html>