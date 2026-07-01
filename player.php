<?php
// play/index.php

$token = isset($_GET['token']) ? trim($_GET['token']) : '';

function error_page($msg) {
    ?>
    <!DOCTYPE html>
    <html lang="bn">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Token Error</title>
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body {
                font-family: 'Inter', 'Segoe UI', sans-serif;
                background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            .error-container {
                background: rgba(255, 255, 255, 0.08);
                backdrop-filter: blur(20px);
                border-radius: 24px;
                padding: 40px 30px;
                width: 100%;
                max-width: 500px;
                text-align: center;
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 25px 45px rgba(0, 0, 0, 0.5);
                animation: fadeIn 0.5s ease;
            }
            .error-icon {
                width: 80px;
                height: 80px;
                background: rgba(255, 71, 87, 0.15);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 25px;
            }
            .error-icon svg {
                width: 40px;
                height: 40px;
                fill: #ff4757;
            }
            .error-container h2 {
                color: #ff6b81;
                font-size: 28px;
                margin-bottom: 15px;
                font-weight: 700;
            }
            .error-container p {
                color: rgba(255, 255, 255, 0.8);
                font-size: 16px;
                line-height: 1.6;
                margin-bottom: 30px;
            }
            .back-btn {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                background: linear-gradient(90deg, #28e98c, #20bd73);
                color: #000;
                padding: 14px 32px;
                border-radius: 50px;
                text-decoration: none;
                font-weight: 700;
                font-size: 16px;
                transition: all 0.3s ease;
                box-shadow: 0 10px 25px rgba(40, 233, 140, 0.4);
            }
            .back-btn:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 35px rgba(40, 233, 140, 0.6);
                background: linear-gradient(90deg, #20bd73, #28e98c);
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @media (max-width: 576px) {
                .error-container {
                    padding: 30px 20px;
                }
                .error-container h2 {
                    font-size: 24px;
                }
            }
        </style>
    </head>
    <body>
        <div class="error-container">
            <div class="error-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                </svg>
            </div>
            <h2>Error</h2>
            <p><?php echo htmlspecialchars($msg); ?></p>
            <a class="back-btn" href="javascript:history.back()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Back to Previous Page
            </a>
        </div>
    </body>
    </html>
    <?php
    exit;
}

if (!$token) error_page('দুঃখিত, Token পাওয়া যায়নি।');

$api_url = "https://hdmoviebd.wuaze.com/wp-json/sedt/v1/check-token?token=" . urlencode($token);
$response = @file_get_contents($api_url);

if (!$response) error_page('সার্ভারে সংযোগ স্থাপন করা যায়নি।');

$data = json_decode($response, true);

if (!$data || empty($data['url'])) error_page('ভুল বা মেয়াদোত্তীর্ণ Token।');

$video_url = $data['url'];
$video_name = isset($data['name']) ? $data['name'] : 'Untitled Video';
$video_quality = isset($data['quality']) ? $data['quality'] : 'HD';
$video_lang = isset($data['lang']) ? $data['lang'] : 'Unknown';
$video_size = isset($data['size']) ? $data['size'] : 'N/A';
$download_link = "https://cinezy.shop/secure-download/?token=" . urlencode($token);

$logo_url = "https://mlykp8akijsc.i.optimole.com/cb:S_p9.9b2/w:auto/h:auto/q:mauto/ig:avif/https://hdmoviebd.wuaze.com/wp-content/uploads/2025/11/Gemini_Generated_Image_xu6ginxu6ginxu6g-removebg-preview.png";

$is_zipped = stripos($video_quality, 'zip') !== false;
?>
<!DOCTYPE html>
<html lang="bn" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($video_name); ?> | Cinezy</title>
    
    <!-- Site Icon / Favicon -->
    <link rel="icon" href="https://cinezy.shop/wp-content/uploads/2025/11/cropped-cropped_circle_image-1.png" type="image/png">
    <link rel="apple-touch-icon" href="https://cinezy.shop/wp-content/uploads/2025/11/cropped-cropped_circle_image-1.png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- ArtPlayer CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/artplayer/dist/artplayer.css">
    
    <style>
        :root {
            --primary: #28e98c;
            --primary-dark: #20bd73;
            --secondary: #6c63ff;
            --danger: #ff4757;
            --warning: #ffcc00;
            --bg-dark: #0a0a0f;
            --bg-darker: #050508;
            --bg-card: rgba(20, 20, 30, 0.8);
            --text-primary: #ffffff;
            --text-secondary: #a0a0b0;
            --text-muted: #6b7280;
            --border-color: rgba(255, 255, 255, 0.1);
            --glass-bg: rgba(255, 255, 255, 0.05);
            --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.5);
            --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.3);
            --radius-lg: 20px;
            --radius-md: 12px;
            --radius-sm: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .header {
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
            background: rgba(10, 10, 15, 0.95);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo {
            height: 45px;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .site-title {
            font-size: 18px;
            font-weight: 700;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: none;
        }

        .token-info {
            background: var(--glass-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            padding: 8px 15px;
            font-size: 13px;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 8px;
            overflow: hidden;
        }

        .token-info i {
            color: var(--primary);
        }

        /* Main Content */
        .main-content {
            padding: 30px 0;
        }

        /* Player Container */
        #artplayer {
            width: 100%;
            aspect-ratio: 16/9;
            max-height: 80vh;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            margin-bottom: 30px;
        }

        /* ZIP Container */
        .zip-container {
            width: 100%;
            aspect-ratio: 16/9;
            background: linear-gradient(rgba(10, 10, 15, 0.95), rgba(10, 10, 15, 0.98)), 
                        url('https://images.unsplash.com/photo-1611224923853-80b023f02d71?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            margin-bottom: 30px;
        }

        .zip-icon {
            width: 100px;
            height: 100px;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            border: 2px solid rgba(40, 233, 140, 0.3);
            box-shadow: 0 10px 30px rgba(40, 233, 140, 0.2);
        }

        .zip-icon svg {
            width: 50px;
            height: 50px;
            fill: var(--primary);
        }

        .zip-title {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 15px;
            color: var(--text-primary);
        }

        .zip-desc {
            font-size: 16px;
            color: var(--text-secondary);
            max-width: 600px;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .zip-desc span {
            color: var(--primary);
            font-weight: 600;
        }

        /* Video Info Card */
        .video-info-card {
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            border-radius: var(--radius-lg);
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-md);
        }

        .video-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-primary);
            line-height: 1.4;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .meta-icon {
            width: 40px;
            height: 40px;
            background: var(--glass-bg);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 18px;
        }

        .meta-content h4 {
            font-size: 13px;
            color: var(--text-secondary);
            margin-bottom: 3px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .meta-content p {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Download Card */
        .download-card {
            background: linear-gradient(135deg, rgba(40, 233, 140, 0.1), rgba(108, 99, 255, 0.1));
            border: 1px solid rgba(40, 233, 140, 0.2);
            border-radius: var(--radius-lg);
            padding: 25px;
            text-align: center;
        }

        .download-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .download-icon {
            width: 50px;
            height: 50px;
            background: rgba(40, 233, 140, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 22px;
        }

        .download-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .download-desc {
            color: var(--text-secondary);
            margin-bottom: 25px;
            font-size: 15px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-download {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            color: #000;
            padding: 16px 35px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(40, 233, 140, 0.4);
            border: none;
            cursor: pointer;
            width: 100%;
            max-width: 300px;
        }

        .btn-download:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(40, 233, 140, 0.6);
            background: linear-gradient(90deg, var(--primary-dark), var(--primary));
        }

        /* Audio Notice */
        .audio-notice {
            background: rgba(255, 204, 0, 0.1);
            border-left: 4px solid var(--warning);
            border-radius: var(--radius-md);
            padding: 18px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .audio-notice i {
            color: var(--warning);
            font-size: 22px;
            min-width: 30px;
        }

        .audio-notice p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            line-height: 1.6;
        }

        .audio-notice strong {
            color: var(--warning);
        }

        /* Footer */
        .footer {
            padding: 30px 0;
            border-top: 1px solid var(--border-color);
            text-align: center;
            color: var(--text-secondary);
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 15px;
            }
            
            .header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .site-title {
                display: block;
            }
            
            #artplayer {
                aspect-ratio: 16/9;
                max-height: 60vh;
            }
            
            .zip-container {
                aspect-ratio: 16/9;
            }
            
            .zip-title {
                font-size: 24px;
            }
            
            .zip-desc {
                font-size: 14px;
                padding: 0 10px;
            }
            
            .video-title {
                font-size: 20px;
            }
            
            .meta-grid {
                grid-template-columns: 1fr;
            }
            
            .btn-download {
                padding: 14px 25px;
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo-container">
                    <a href="https://cinezy.shop/">
                        <img src="<?php echo $logo_url; ?>" alt="Cinezy" class="logo">
                    </a>
                    <div class="site-title">Cinezy</div>
                </div>
                <div class="token-info">
                    <i class="fas fa-key"></i>
                    <span>Token: <?php echo substr($token, 0, 8) . '...'; ?></span>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Player Container -->
            <?php if ($is_zipped): ?>
                <div class="zip-container">
                    <div class="zip-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 6h-8l-2-2H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm0 12H4V8h16v10zM14 16l4-4h-3V9h-2v3h-3l4 4z"/>
                        </svg>
                    </div>
                    <h2 class="zip-title">Zipped Content</h2>
                    <p class="zip-desc">
                        This video file is compressed in a ZIP archive. Please <span>download</span> and <span>extract</span> to watch.
                    </p>
                    <a href="<?php echo htmlspecialchars($download_link); ?>" target="_blank" class="btn-download">
                        <i class="fas fa-download"></i>
                        Download ZIP File
                    </a>
                </div>
            <?php else: ?>
                <!-- ArtPlayer Container -->
                <div id="artplayer"></div>
            <?php endif; ?>

            <!-- Audio Notice -->
            <div class="audio-notice">
                <i class="fas fa-volume-up"></i>
                <p>
                    <strong>Note:</strong> If you experience audio issues, please download the video and play it with 
                    <strong>VLC Media Player</strong> for the best experience (supports both English and Bangla audio tracks).
                </p>
            </div>

            <!-- Video Info Card -->
            <div class="video-info-card">
                <h1 class="video-title"><?php echo htmlspecialchars($video_name); ?></h1>
                <div class="meta-grid">
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-film"></i>
                        </div>
                        <div class="meta-content">
                            <h4>Quality</h4>
                            <p><?php echo htmlspecialchars($video_quality); ?></p>
                        </div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-language"></i>
                        </div>
                        <div class="meta-content">
                            <h4>Language</h4>
                            <p><?php echo htmlspecialchars($video_lang); ?></p>
                        </div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-weight-hanging"></i>
                        </div>
                        <div class="meta-content">
                            <h4>Size</h4>
                            <p><?php echo htmlspecialchars($video_size); ?></p>
                        </div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="meta-content">
                            <h4>Duration</h4>
                            <p id="durationMeta">Loading...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Download Card -->
            <div class="download-card">
                <div class="download-header">
                    <div class="download-icon">
                        <i class="fas fa-cloud-download-alt"></i>
                    </div>
                    <h2 class="download-title">Download This Video</h2>
                </div>
                <p class="download-desc">
                    Get the highest quality version of this video for offline viewing. 
                    The download will start immediately when you click the button below.
                </p>
                <a href="<?php echo htmlspecialchars($download_link); ?>" target="_blank" class="btn-download">
                    <i class="fas fa-download"></i>
                    Download Now
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>© <?php echo date('Y'); ?> Cinezy | HD Movie BD. All rights reserved.</p>
            <p style="margin-top: 5px; font-size: 13px; opacity: 0.7;">
                Stream securely with token-based access protection.
            </p>
        </div>
    </footer>

    <!-- ArtPlayer Script -->
    <script src="https://cdn.jsdelivr.net/npm/artplayer/dist/artplayer.js"></script>
    <script>
        <?php if (!$is_zipped): ?>
        document.addEventListener('DOMContentLoaded', function() {
            try {
                const art = new Artplayer({
                    container: '#artplayer',
                    url: '<?php echo htmlspecialchars($video_url); ?>',
                    title: '<?php echo htmlspecialchars($video_name); ?>',
                    poster: 'https://images.unsplash.com/photo-1611224923853-80b023f02d71?ixlib=rb-4.0.3&auto=format&fit=crop&w=1280&q=80',
                    volume: 0.5,
                    autoplay: false,
                    fullscreen: true,
                    fullscreenWeb: true,
                    backdrop: true,
                    playbackRate: true,
                    aspectRatio: true,
                    screenshot: true,
                    subtitle: {
                        url: ''
                    },
                });

                // Update duration metadata
                art.on('loadedmetadata', function() {
                    const duration = art.duration;
                    if (duration && !isNaN(duration)) {
                        const hours = Math.floor(duration / 3600);
                        const minutes = Math.floor((duration % 3600) / 60);
                        const seconds = Math.floor(duration % 60);
                        const formattedDuration = hours > 0 
                            ? `${hours}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`
                            : `${minutes}:${String(seconds).padStart(2, '0')}`;
                        document.getElementById('durationMeta').textContent = formattedDuration;
                    }
                });

                // Error handling
                art.on('error', function(error) {
                    console.error('Player Error:', error);
                });
            } catch (error) {
                console.error('ArtPlayer initialization error:', error);
            }
        });
        <?php endif; ?>
    </script>

    <!-- Ad Scripts (keeping existing functionality) -->
    <script>
        (function() {
            const AD_URL = 'https://otieu.com/4/10545848';
            const BANNER_INTERVAL_MS = 30000;
            const PLAYER_INTERVAL_MS = 10 * 60 * 1000;
            let bannerOpenAllowed = false;

            function openPopunder() {
                const win = window.open(AD_URL, '_blank', 'noopener');
                if (win) {
                    try { win.blur(); window.focus(); } catch(e){}
                }
            }

            function createBanner() {
                if (document.getElementById('user-ad-banner')) return;
                bannerOpenAllowed = true;
                const banner = document.createElement('div');
                banner.id = 'user-ad-banner';
                Object.assign(banner.style, {position:'fixed',bottom:'12px',right:'12px',background:'#222',color:'#fff',padding:'10px 12px',borderRadius:'6px',zIndex:99999,boxShadow:'0 2px 8px rgba(0,0,0,0.3)',display:'flex',alignItems:'center',gap:'8px',fontSize:'14px'});
                const text = document.createElement('span');
                text.textContent = 'Special Offer — click anywhere to open';
                text.style.marginRight = '8px';
                const openBtn = document.createElement('button');
                openBtn.textContent = 'Open';
                Object.assign(openBtn.style,{cursor:'pointer',background:'#28e98c',color:'#000',border:'none',padding:'4px 8px',borderRadius:'3px',fontWeight:'bold'});
                openBtn.addEventListener('click', function(e){ e.stopPropagation(); bannerOpenAllowed=false; openPopunder(); removeBanner(); });
                const closeBtn = document.createElement('button');
                closeBtn.textContent = '✕';
                Object.assign(closeBtn.style,{cursor:'pointer',background:'transparent',color:'#fff',border:'none',fontSize:'16px'});
                closeBtn.addEventListener('click', function(e){ e.stopPropagation(); removeBanner(); });
                banner.appendChild(text);
                banner.appendChild(openBtn);
                banner.appendChild(closeBtn);
                document.body.appendChild(banner);
                setTimeout(removeBanner, BANNER_INTERVAL_MS - 5000);
            }

            function removeBanner(){ const b = document.getElementById('user-ad-banner'); if (b) b.remove(); bannerOpenAllowed=false; }

            document.addEventListener('click', function(e){
                if (!bannerOpenAllowed) return;
                bannerOpenAllowed=false;
                openPopunder();
                removeBanner();
            }, true);

            createBanner();
            setInterval(createBanner, BANNER_INTERVAL_MS);

            function showPlayerPrompt() {
                const player = document.getElementById('artplayer');
                if (!player) return;
                const id = 'player-offer-overlay';
                if (player.querySelector('#'+id)) return;
                const overlay = document.createElement('div');
                overlay.id = id;
                Object.assign(overlay.style,{position:'absolute',inset:'0',display:'flex',alignItems:'center',justifyContent:'center',background:'rgba(0,0,0,0.6)',zIndex:9999,top:'0',left:'0'});
                const btn = document.createElement('button');
                btn.textContent = 'View Offer';
                Object.assign(btn.style,{padding:'10px 16px',fontSize:'16px',cursor:'pointer',background:'#28e98c',color:'#000',border:'none',borderRadius:'5px',fontWeight:'bold'});
                btn.addEventListener('click', function(){ openPopunder(); overlay.remove(); });
                overlay.appendChild(btn);
                if (getComputedStyle(player).position === 'static') player.style.position = 'relative';
                player.appendChild(overlay);
                setTimeout(()=>overlay.remove(), 20000);
            }

            setInterval(showPlayerPrompt, PLAYER_INTERVAL_MS);
        })();
    </script>

</body>
</html>