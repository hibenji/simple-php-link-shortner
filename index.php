<?php
$shortUrl = null;
$submittedUrl = '';

if (isset($_POST['url'])) {
    $submittedUrl = trim($_POST['url']);
    $rand = rand(1, 9999);

    $myfile = fopen($rand . '.php', 'w');
    $txt = "<?php header('Location: " . $submittedUrl . "');?>";
    fwrite($myfile, $txt);
    fclose($myfile);

    $shortUrl = 'https://short.benji.link/' . $rand;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Benji's Link Shortener</title>
    <meta name="description" content="Short links with a simple web form and direct redirect URLs.">
    <meta name="theme-color" content="#0f766e">
    <style>
        :root {
            color-scheme: light dark;
            --bg: #f7f7f4;
            --panel: #ffffff;
            --text: #202124;
            --muted: #62656a;
            --line: #d8d7d2;
            --accent: #0f766e;
            --accent-strong: #115e59;
            --code-bg: #1f2937;
            --code-text: #f8fafc;
            --danger: #b42318;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            line-height: 1.5;
        }

        main {
            width: min(960px, calc(100% - 32px));
            margin: 0 auto;
            padding: 48px 0;
        }

        header {
            margin-bottom: 32px;
        }

        h1 {
            margin: 0 0 8px;
            font-size: clamp(2rem, 6vw, 4.5rem);
            line-height: 1;
            letter-spacing: 0;
        }

        h2 {
            margin: 0 0 14px;
            font-size: 1.25rem;
        }

        p {
            margin: 0;
            color: var(--muted);
        }

        section {
            border-top: 1px solid var(--line);
            padding: 28px 0;
        }

        .grid {
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(0, 0.85fr);
            gap: 24px;
        }

        .panel {
            display: grid;
            gap: 14px;
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 20px;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 18px;
            padding: 6px 10px;
            border: 1px solid var(--line);
            border-radius: 999px;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: var(--accent);
        }

        form {
            display: grid;
            gap: 14px;
        }

        label {
            font-weight: 600;
        }

        input[type="url"] {
            width: 100%;
            min-height: 48px;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 0 14px;
            background: transparent;
            color: var(--text);
            font: inherit;
        }

        input[type="url"]::placeholder {
            color: var(--muted);
        }

        button {
            justify-self: start;
            min-height: 42px;
            border: 0;
            border-radius: 8px;
            padding: 0 16px;
            background: var(--accent);
            color: #ffffff;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
        }

        button:hover {
            background: var(--accent-strong);
        }

        a {
            color: var(--accent-strong);
        }

        code,
        pre {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
        }

        pre {
            margin: 0;
            overflow-x: auto;
            border-radius: 8px;
            padding: 16px;
            background: var(--code-bg);
            color: var(--code-text);
            font-size: 0.92rem;
        }

        .copy-block {
            cursor: pointer;
            position: relative;
            border: 1px solid transparent;
            transition: border-color 160ms ease, transform 160ms ease;
        }

        .copy-block::after {
            content: attr(data-copy-label);
            position: absolute;
            top: 10px;
            right: 10px;
            border-radius: 6px;
            padding: 3px 7px;
            background: rgba(255, 255, 255, 0.14);
            color: var(--code-text);
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 0.75rem;
            opacity: 0;
            transform: translateY(-2px);
            transition: opacity 160ms ease, transform 160ms ease;
        }

        .copy-block:hover,
        .copy-block:focus {
            border-color: rgba(20, 184, 166, 0.55);
            outline: none;
        }

        .copy-block:hover::after,
        .copy-block:focus::after,
        .copy-block.is-copied::after,
        .copy-block.is-failed::after {
            opacity: 1;
            transform: translateY(0);
        }

        .copy-block.is-copied {
            border-color: var(--accent);
        }

        .result {
            display: grid;
            gap: 10px;
        }

        .result a {
            overflow-wrap: anywhere;
        }

        .note {
            color: var(--muted);
            font-size: 0.95rem;
        }

        .error {
            color: var(--danger);
            font-weight: 700;
        }

        .site-footer {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border-top: 1px solid var(--line);
            padding: 24px 0 0;
            color: var(--muted);
            text-align: center;
            font-size: 0.95rem;
        }

        .github-link {
            color: inherit;
            line-height: 0;
        }

        .github-logo {
            width: 20px;
            height: 20px;
            fill: currentColor;
            flex: 0 0 auto;
        }

        .site-footer a {
            text-underline-offset: 0.18em;
        }

        @media (max-width: 760px) {
            main {
                padding: 32px 0;
            }

            .grid {
                grid-template-columns: 1fr;
            }
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg: #141412;
                --panel: #1d1d1a;
                --text: #f3f2ed;
                --muted: #bbb8ad;
                --line: #3a3934;
                --accent: #14b8a6;
                --accent-strong: #5eead4;
                --code-bg: #0f172a;
                --code-text: #e2e8f0;
            }

            button {
                color: #09201d;
            }
        }
    </style>
</head>
<body>
    <main>
        <header>
            <h1>Benji's Link Shortener</h1>
            <p>Create short redirect links with a single paste and submit.</p>
            <div class="status">
                <span class="dot" aria-hidden="true"></span>
                <strong>HTTPS</strong> endpoint: <code>https://short.benji.link</code>
            </div>
        </header>

        <section class="grid">
            <div class="panel">
                <div>
                    <h2>Create Short Link</h2>
                    <p>Paste the destination URL and get back a direct short link.</p>
                </div>
                <form action="/" method="post">
                    <div>
                        <label for="url">Destination URL</label>
                    </div>
                    <input
                        type="url"
                        id="url"
                        name="url"
                        placeholder="https://example.com/page"
                        value="<?= htmlspecialchars($submittedUrl, ENT_QUOTES, 'UTF-8') ?>"
                        required
                    >
                    <button type="submit">Shorten</button>
                </form>
            </div>

            <div class="panel">
                <div>
                    <h2>How It Works</h2>
                    <p>Each submission generates a new numeric redirect path on this domain.</p>
                </div>
                <pre class="copy-block" data-copy-label="Copy" tabindex="0">https://short.benji.link/1234</pre>
                <p class="note">The generated short URL opens the destination immediately.</p>
            </div>
        </section>

        <section>
            <div class="panel">
                <h2>Result</h2>
                <?php if ($shortUrl !== null): ?>
                    <div class="result">
                        <p>Your short link is ready.</p>
                        <a href="<?= htmlspecialchars($shortUrl, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">
                            <?= htmlspecialchars($shortUrl, ENT_QUOTES, 'UTF-8') ?>
                        </a>
                        <pre class="copy-block" data-copy-label="Copy" tabindex="0"><?= htmlspecialchars($shortUrl, ENT_QUOTES, 'UTF-8') ?></pre>
                    </div>
                <?php else: ?>
                    <p class="note">Your generated link will appear here after submission.</p>
                <?php endif; ?>
            </div>
        </section>

        <footer class="site-footer">
            <span>Link Shortener</span>
            <a class="github-link" href="https://github.com/hibenji/simple-php-link-shortner" target="_blank" rel="noopener noreferrer" aria-label="GitHub repository">
                <svg class="github-logo" aria-hidden="true" viewBox="0 0 98 96" xmlns="http://www.w3.org/2000/svg">
                    <path d="M48.9 0C21.9 0 0 22 0 49.1c0 21.7 14 40.1 33.4 46.6 2.4.4 3.3-1.1 3.3-2.4 0-1.2 0-5.2-.1-9.4-13.6 3-16.5-5.8-16.5-5.8-2.2-5.7-5.4-7.2-5.4-7.2-4.4-3 .3-3 .3-3 4.9.3 7.5 5.1 7.5 5.1 4.4 7.5 11.5 5.3 14.3 4.1.4-3.2 1.7-5.3 3.1-6.6-10.9-1.2-22.3-5.4-22.3-24.2 0-5.3 1.9-9.7 5.1-13.1-.5-1.2-2.2-6.2.5-12.9 0 0 4.1-1.3 13.5 5 3.9-1.1 8.1-1.6 12.2-1.6s8.3.5 12.2 1.6c9.4-6.3 13.5-5 13.5-5 2.7 6.7 1 11.7.5 12.9 3.2 3.4 5.1 7.8 5.1 13.1 0 18.8-11.5 23-22.4 24.2 1.8 1.5 3.3 4.5 3.3 9.1 0 6.6-.1 11.9-.1 13.5 0 1.3.9 2.9 3.4 2.4C84 89.2 98 70.8 98 49.1 98 22 76.1 0 48.9 0Z"/>
                </svg>
            </a>
            <span>Made by <a href="https://benji.link" target="_blank" rel="noopener noreferrer">Benji</a> with ❤️</span>
        </footer>
    </main>
    <script>
        const copyBlocks = document.querySelectorAll(".copy-block");

        copyBlocks.forEach((block) => {
            const setCopyState = (label, className) => {
                block.dataset.copyLabel = label;
                block.classList.remove("is-copied", "is-failed");
                block.classList.add(className);

                window.setTimeout(() => {
                    block.dataset.copyLabel = "Copy";
                    block.classList.remove(className);
                }, 1400);
            };

            const fallbackCopy = (text) => {
                const textarea = document.createElement("textarea");
                textarea.value = text;
                textarea.setAttribute("readonly", "");
                textarea.style.position = "fixed";
                textarea.style.top = "-1000px";
                textarea.style.left = "-1000px";
                document.body.appendChild(textarea);
                textarea.select();

                try {
                    const copied = document.execCommand("copy");
                    document.body.removeChild(textarea);
                    return copied;
                } catch (error) {
                    document.body.removeChild(textarea);
                    return false;
                }
            };

            const copyText = async () => {
                const text = block.textContent.trim();

                if (navigator.clipboard && window.isSecureContext) {
                    try {
                        await navigator.clipboard.writeText(text);
                        setCopyState("Copied", "is-copied");
                        return;
                    } catch (error) {
                        // Fall back for browsers that expose the API but deny it.
                    }
                }

                if (fallbackCopy(text)) {
                    setCopyState("Copied", "is-copied");
                    return;
                }

                setCopyState("Failed", "is-failed");
            };

            block.addEventListener("click", copyText);
            block.addEventListener("keydown", (event) => {
                if (event.key === "Enter" || event.key === " ") {
                    event.preventDefault();
                    copyText();
                }
            });
        });
    </script>
</body>
</html>
