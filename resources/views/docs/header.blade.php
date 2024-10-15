<style>
    .hdr-mn_wrpr {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding: calc(1rem*0.5) 1rem;
        box-shadow: 0 1px 2px 0 rgba(0,0,0,.1);
        position: -webkit-sticky;
        position: sticky;
        top: 0;
    }
    .hdr-ttl_cntnr {
        flex: 1;
    }
    .nvbr-ttl_wrpr {
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    .nvbr-logo {
        width: 1.5rem;
        margin-right: .6rem;
    }
    .nvbr-ttl {
        font-size: 1.2rem;
        font-family: KanitRegular;
        color: #1c1e21;
    }
    .hdr-cntnt_wrpr {
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    a.hdr-tool-itm {
        display: flex;
        flex-direction: row;
        padding: .25rem .75rem;
    }
    a.hdr-tool-itm[active] > span {
        color: #007fef;
    }
    .hdr-tool-itm > span {
        font-size: 1.2rem;
        font-weight: 500;
        font-family: KanitRegular;
        color: #1c1e21;
    }
    .external_link {
        width: .8rem;
        margin-left: .2rem;
    }
    .hdr-tool-itm.toggle {
        width: 48px;
        height: 24px;
        display: flex;
        flex-direction: row;
        align-items: center;
        position: relative;
        padding: .1rem;
        border-radius: 1rem;
        cursor: pointer;
        background-color: #1c1e21db;
        user-select: none;
    }
    .toggle >
    .tggl-cycl {
        z-index: 2;
        width: 20px;
        height: 20px;
        position: absolute;
        left: 2px;
        background-color: #f9f7f1;
        border-radius: 2rem;
        transition: all 250ms ease-in-out;
    }
    .toggle >
    .tggl-icn {
        z-index: 1;
        position: absolute;
        display: inline-block;
        font-size: 1rem !important;
    }
    .toggle >
    .tggl-icn.moon {
        left: 2px;
    }
    .toggle >
    .tggl-icn.soon {
        right: 3px;
    }
    .hdr-tool-itm.search-box {
        padding: .25rem .75rem;
        cursor: pointer;
    }
    .doc-srch-bx_wrpr {
        width: 100%;
        height: 36px;
        display: flex;
        flex-direction: row;
        align-items: center;
        user-select: none;
        padding: 0 8px;
        border-radius: 4rem;
        background-color: #ebedf0;
        border: 2px solid transparent;
        transition: all 200ms cubic-bezier(0.08,0.52,0.52,1);
    }
    .doc-srch-bx_wrpr:hover {
        border: 2px solid #007fef;
    }
    .doc-srch-bttn_wrpr {
        display: flex !important;
        flex-direction: row;
        align-items: center;
    }
    .doc-srch-icn {
        width: 1.1rem;
    }
    .doc-srch-plchldr {
        color: #969faf;
        font-size: 1rem;
        font-family: SourceSansPro;
        margin-left: .15rem;
        padding: 0 12px 0 6px;
    }
    .doc-srch-command_wrpr {
        width: 20px;
        height: 18px;
        display: flex;
        position: relative;
        align-items: center;
        justify-content: center;
        background: linear-gradient(-225deg,#d5dbe4,#f8f8f8);
        border-radius: 3px;
        box-shadow: inset 0 -2px 0 0 #cdcde6,inset 0 0 1px 1px #fff,0 1px 2px 1px rgba(30,35,90,.4);
        margin-right: .4em;
        padding-bottom: 2px;
        color: #969faf;
        top: -1px;
        font-size: 15px;
        font-family: SourceSansPro;
    }
    .doc-srch-command_wrpr >
    svg {
        width: 15px;
    }
    .doc-srch-command_wrpr >
    span {
        bottom: 1px;
        position: relative;
    }
</style>
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
