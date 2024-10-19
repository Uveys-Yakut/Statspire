@section('head')
    <title>{{ $pageMetaData['title'] }}</title>
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="description" content="{{ $pageMetaData['description'] }}">
    <link rel="stylesheet" href="{{ asset('css/docs/page.css') }}">
@endsection
<div class="doc_cntnr">
    <article>
        <div class="theme-doc-yaml">
            <header>
                <h1>Lorem Ipsum</h1>
            </header>
            <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Ultricies sagittis arcu at ullamcorper praesent efficitur habitasse sagittis. Ac vestibulum dis ultrices mollis aliquet. Aliquam justo duis taciti feugiat; curabitur varius.</p>
            <h2 class="anchor" id="hendrerit">
                Hendrerit
                <a class="hash-link" href="#hendrerit" title="Direct link to heading">&ZeroWidthSpace;</a>
            </h2>
            <div class="codeBlockContent">
                <pre class="thin-scrollbar">
                    <code>lorem ipsum-odor-amet</code>
                    <code>eget ornare-arcu</code>
                    <code>lectus magnis-eros</code>
                </pre>
                <button type="button" aria-label="Copy code to clipboard" class="copyButton">Copy</button>
            </div>
            <blockquote>
                <p>Lorem ipsum odor amet, <code>consectetuer adipiscing</code> elit. Augue leo consectetur sodales ad <code>ante fringilla dapibus</code> auctor. Malesuada a tempor viverra aenean sollicitudin massa. Tellus erat placerat quis suscipit euismod class senectus quis odio.</p>
            </blockquote>
            <p>
                <em>
                    (<a class="link" href="#" target="_blank" rel="noopener noreferrer">Lorem</a> ipsum odor amet, consectetuer <a class="link" href="#" target="_blank" rel="noopener noreferrer">adipiscing elit</a>)
                </em>
            </p>
            <p>
                Ehicula lectus felis <a class="link" href="#" target="_blank" rel="noopener noreferrer">http://localhost:3000/</a> quis varius urna.
            </p>
            <p>
                Phasellus sollicitudin euismod tincidunt nisi libero class <code>metus sociosqu eget</code>
            </p>
            <p style="text-align: center;">
                <img src="https://dragon.cloud/29MZbInIlmcx_iLweMtQrw.gif" style="border-radius: .5rem" width="600" alt="npm start">
            </p>
            <h3 class="anchor" id="pulvinar-magna">
                Pulvinar Magna
                <a class="hash-link" href="#pulvinar-magna" title="Direct link to heading"></a>
            </h3>
            <p>
                Purus <strong>Ullamcorper</strong> montes feugiat primis morbi imperdiet natoque aenean. Mi natoque varius magna ante faucibus! Ut ut bibendum magna dictum amet sagittis.
            </p>
            <p>
                Create a project, and you’re good to go.
            </p>
            <h2 class="anchor" id="amet-sodales">
                Amet Sodales
                <a class="hash-link" href="#amet-sodales" title="Direct link to heading">&ZeroWidthSpace;</a>
            </h2>
            <p>
                <strong>Amet sodales parturient accumsan imperdiet tincidunt at.</strong> Ornare quis congue mattis sodales mollis inceptos. Vestibulum ut ad rutrum lectus lacinia justo penatibus. Placerat dapibus imperdiet purus commodo hac venenatis. Primis netus ornare laoreet netus ornare. Lectus cras risus luctus conubia rutrum est nisl nullam
            </p>
            <p>
                Tempor massa suspendisse luctus posuere massa:
            </p>
            <h3 id="diam">
                Diam
                <a class="hash-link" href="#diam" title="Direct link to heading">&ZeroWidthSpace;</a>
            </h3>
            <div class="codeBlockContent">
                <pre class="thin-scrollbar">
                    <code>aptent interdum-suscipit</code>
                </pre>
                <button type="button" aria-label="Copy code to clipboard" class="copyButton">Copy</button>
            </div>
            <h3 id="turpis">
                Turpis
                <a class="hash-link" href="#turpis" title="Direct link to heading">&ZeroWidthSpace;</a>
            </h3>
            <div class="codeBlockContent">
                <pre class="thin-scrollbar">
                    <code>morbi imperdiet-natoque</code>
                </pre>
                <button type="button" aria-label="Copy code to clipboard" class="copyButton">Copy</button>
            </div>
            <h3 id="litora">
                Litora
                <a class="hash-link" href="#litora" title="Direct link to heading">&ZeroWidthSpace;</a>
            </h3>
            <div class="codeBlockContent">
                <pre class="thin-scrollbar">
                    <code>habitant facilisis-vel-sed</code>
                </pre>
                <button type="button" aria-label="Copy code to clipboard" class="copyButton">Copy</button>
            </div>
            <div style="padding-top: 10rem;"></div>
        </div>
        <aside class="scrollspy_wrpr">
            <div class="table-of-content_wrpr thin-scrollbar">
                <ul>
                    <li>
                        <a class="tble-of-cntnt-itm__lnk active" href="#hendrerit">Hendrerit</a>
                        <ul>
                            <li>
                                <a class="tble-of-cntnt-itm__lnk" href="#pulvinar-magna">Pulvinar Magna</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="tble-of-cntnt-itm__lnk" href="#amet-sodales">Amet Sodales</a>
                        <ul>
                            <li>
                                <a class="tble-of-cntnt-itm__lnk" href="#diam">Diam</a>
                            </li>
                            <li>
                                <a class="tble-of-cntnt-itm__lnk" href="#turpis">Turpis</a>
                            </li>
                            <li>
                                <a class="tble-of-cntnt-itm__lnk" href="#litora">Litora</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
    </article>
</div>
<script>
    $(document).ready(() => {
        $('.table-of-content_wrpr.thin-scrollbar').css('max-height', `${$('.table-of-content_wrpr')[0].children[0].offsetHeight+1}px`);
        $('.doc-sdbr_wrpr').css('top', `${$('.hdr-mn_wrpr')[0].clientHeight}px`);

        $(".copyButton").click(function() {
            const $button = $(this);

            if ($button.text() === "Copied") {
                return;
            }

            const contentToBeCopied = $button.parent()[0].children[0].innerText;
            const $tempInput = $('<textarea>');

            $tempInput.val(contentToBeCopied);
            $('body').append($tempInput);

            $tempInput.select();
            document.execCommand('copy');

            $tempInput.remove();

            $button.text("Copied").prop('disabled', true);

            setTimeout(() => {
                $button.text("Copy").prop('disabled', false);
            }, 2000);
        });
    });
</script>
