<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة عصام صاصا - الصفحة الرسمية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-color: #0b0e14;
            --card-bg: #161b26;
            --primary-color: #e11d48;
            --text-color: #ffffff;
            --text-secondary: #9ca3af;
            --border-color: #1f2937;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Cairo', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            padding-bottom: 90px;
        }

        header {
            background: rgba(11, 14, 20, 0.9);
            backdrop-filter: blur(10px);
            padding: 20px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid var(--border-color);
        }

        .logo {
            font-size: 1.6rem;
            font-weight: 900;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-box {
            position: relative;
            width: 300px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border-radius: 20px;
            border: 1px solid var(--border-color);
            background: var(--card-bg);
            color: #fff;
            outline: none;
        }

        .search-box i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        .container {
            padding: 30px 5%;
        }

        .section-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .songs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }

        .song-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            transition: 0.3s ease;
            cursor: pointer;
        }

        .song-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
        }

        .song-card i.cover-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin: 15px 0;
        }

        .song-title {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 8px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Player Bar */
        .player-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #111622;
            border-top: 1px solid var(--border-color);
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }

        .now-playing {
            display: flex;
            align-items: center;
            gap: 15px;
            width: 30%;
        }

        .player-controls {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            width: 40%;
        }

        .control-btns {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .control-btns button {
            background: none;
            border: none;
            color: #fff;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .control-btns button.play-btn {
            font-size: 1.8rem;
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            header { flex-direction: column; gap: 15px; }
            .search-box { width: 100%; }
            .player-bar { flex-direction: column; gap: 10px; text-align: center; }
            .now-playing { width: 100%; justify-content: center; }
            .player-controls { width: 100%; }
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">
            <i class="fa-solid fa-compact-disc"></i> عصام صاصا الكروان
        </div>
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="searchInput" onkeyup="filterSongs()" placeholder="ابحث عن مهرجان...">
        </div>
    </header>

    <div class="container">
        <h2 class="section-title">أحدث المهرجانات</h2>
        <div class="songs-grid" id="songsGrid">
            <!-- قائمة الأغاني بتتحمل تلقائياً من JS -->
        </div>
    </div>

    <!-- Bottom Player -->
    <div class="player-bar">
        <div class="now-playing">
            <i class="fa-solid fa-music" style="color: var(--primary-color); font-size: 1.5rem;"></i>
            <div>
                <div class="song-title" id="playerTitle">اختر أغنية للتشغيل</div>
                <small style="color: var(--text-secondary);">عصام صاصا</small>
            </div>
        </div>
        <div class="player-controls">
            <audio id="audioPlayer" controls style="width: 100%; max-width: 400px; height: 35px;"></audio>
        </div>
    </div>

    <script>
        const songs = [
            { title: "يا صاحبي خد بالك", url: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" },
            { title: "في يوم فراقك", url: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3" },
            { title: "أنا المفتري", url: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3" },
            { title: "شايفنى بس مش شايفينى", url: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-4.mp3" }
        ];

        function renderSongs(songList) {
            const grid = document.getElementById('songsGrid');
            grid.innerHTML = songList.map((song, index) => `
                <div class="song-card" onclick="playSong('${song.title}', '${song.url}')">
                    <i class="fa-solid fa-record-vinyl cover-icon"></i>
                    <div class="song-title">${song.title}</div>
                    <small style="color: var(--text-secondary);">استماع الآن</small>
                </div>
            `).join('');
        }

        function playSong(title, url) {
            const player = document.getElementById('audioPlayer');
            document.getElementById('playerTitle').innerText = title;
            player.src = url;
            player.play();
        }

        function filterSongs() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const filtered = songs.filter(s => s.title.toLowerCase().includes(query));
            renderSongs(filtered);
        }

        renderSongs(songs);
    </script>
</body>
</html>