<div class="hdr-mn_wrpr">
    <div class="hdr-ttl_cntnr">
        <a href="#" class="nvbr-ttl_wrpr">
            <span class="nvbr-ttl">Staspire Documentation</span>
        </a>
    </div>
    <div class="hdr-cntnt_wrpr">
        <a href="#" class="hdr-tool-itm" active>
            <span>Docs</span>
        </a>
        <a href="#" class="hdr-tool-itm" target="_blank" rel="noopener noreferrer">
            <span>Helps</span>
            <img class="external_link" src="{{ asset('assets/svg/external_link.svg') }}" alt="Icon External Link">
        </a>
        <a href="https://github.com/Uveys-Yakut/Statspire" class="hdr-tool-itm" target="_blank" rel="noopener noreferrer">
            <span>Github</span>
            <img class="external_link" src="{{ asset('assets/svg/external_link.svg') }}" alt="Icon External Link">
        </a>
        <div class="hdr-tool-itm toggle">
            <div class="tggl-cycl"></div>
            <span class="tggl-icn moon">🌜</span>
            <span class="tggl-icn soon">🌞</span>
        </div>
        <div class="hdr-tool-itm search-box">
            <div class="doc-srch-bx_wrpr">
                <div class="doc-srch-bttn_wrpr">
                    <img class="doc-srch-icn" src="{{ asset('assets/svg/search.svg') }}" alt="Search Icon">
                    <span class="doc-srch-plchldr">Search</span>
                </div>
                <div class="doc-srch-command_wrpr">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15">
                        <path d="M4.505 4.496h2M5.505 5.496v5M8.216 4.496l.055 5.993M10 7.5c.333.333.5.667.5 1v2M12.326 4.5v5.996M8.384 4.496c1.674 0 2.116 0 2.116 1.5s-.442 1.5-2.116 1.5M3.205 9.303c-.09.448-.277 1.21-1.241 1.203C1 10.5.5 9.513.5 8V7c0-1.57.5-2.5 1.464-2.494.964.006 1.134.598 1.24 1.342M12.553 10.5h1.953" stroke-width="1.2" stroke="currentColor" fill="none" stroke-linecap="square"></path>
                    </svg>
                </div>
                <div class="doc-srch-command_wrpr">
                    <span>K</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(() => {
        $(".hdr-tool-itm.toggle").click(() => {
            const $tgglCycl = $(".tggl-cycl");

            if ($tgglCycl.css("left") === "26px") {
                $tgglCycl.css("left", "2px");
            } else {
                $tgglCycl.css("left", "26px");
            }
        });
    });
</script>
