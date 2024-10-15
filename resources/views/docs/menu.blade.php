<style>
    .doc-sdbr_wrpr {
        height: 100%;
        display: block;
        border-right: 1px solid;
        border-color: #dadde1;
        transition: border-color .5ms ease;
    }
    .sdbr_wrpr {
        width: 300px;
        height: 100%;
        max-height: 100vh;
        display: flex;
        flex-direction: columnu;
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        transition: opacity 50ms;
        overflow-y: auto;
    }
    .sdbr_wrpr::-webkit-scrollbar {
        width: 10px;
    }
    .sdbr_wrpr::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .sdbr_wrpr::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
        border: 2px solid #f1f1f1;
    }
    .sdbr_wrpr::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    .sdbr_wrpr::-webkit-scrollbar-button {
        background: #f1f1f1;
        height: 2px;
    }
    .menu {
        width: 100%;
        padding: .5rem;
        color: #606770;
    }
    .mnu_lst_wrpr {
        list-style: none;
        margin: 0;
        padding-left: 0;
        border-radius: .5rem;
    }
    .mnu_lst-itm_wrpr {
        width: 100%;
        display: flex;
        flex-direction: column;
        margin-top: .25rem;
        cursor: pointer;
    }
    .lst-itm.collapsible {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        position: relative;
        padding: .375rem 1rem;
        border-radius: .5rem;
    }
    .lst-itm.collapsible:hover {
        background-color: #3d3d3d0d;
    }
    .lst-itm.collapsible[lnk-act] >
    span {
        color: #007fef;
    }
    .lst-itm.collapsible[act] >
    svg {
        transform: rotate(180deg) !important;
    }
    .sublst-ttl {
        font-size: 1.1rem;
        font-family: KanitRegular;
        line-height: 1.25;
    }
    .cllpsbl-icn {
        width: 2rem;
        position: absolute;
        right: .375rem;
        transform: rotate(90deg);
        fill: #606770;
        transition: transform .5s ease;
    }
    .lst-itm.cntnt_wrpr {
        width: 100%;
        height: 0px;
        overflow: hidden;
        will-change: height;
        transition: height 284ms ease-in-out;
    }
    /* .lst-itm.collapsible[act] +
    .lst-itm.cntnt_wrpr {
        height: auto;
    } */
    .lst-itm.cntnt_wrpr >
    .mnu_lst-itm_wrpr >
    .lst-itm.collapsible[lnk-act] {
        background-color: #3d3d3d0d;
    }
</style>
<div class="doc-sdbr_wrpr">
    <div class="sdbr_wrpr">
        <nav class="menu">
            <ul class="mnu_lst_wrpr">
                <li class="mnu_lst-itm_wrpr">
                    <div class="lst-itm lv1 collapsible" lnk-act>
                        <span class="sublst-ttl">Introduction</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="cllpsbl-icn" viewBox="0 0 24 24">
                            <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
                        </svg>
                    </div>
                    <ul class="lst-itm cntnt_wrpr">
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible" lnk-act>
                                <span class="sublst-ttl">What is Statspire stats</span>
                            </div>
                        </li>
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Key Features</span>
                            </div>
                        </li>
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Benefits of Using the App</span>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="mnu_lst-itm_wrpr">
                    <div class="lst-itm lv1 collapsible">
                        <span class="sublst-ttl">Installation</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="cllpsbl-icn" viewBox="0 0 24 24">
                            <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
                        </svg>
                    </div>
                    <ul class="lst-itm cntnt_wrpr">
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Requirements</span>
                            </div>
                        </li>
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Installing via Composer</span>
                            </div>
                        </li>
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Running the Application</span>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="mnu_lst-itm_wrpr">
                    <div class="lst-itm lv1 collapsible">
                        <span class="sublst-ttl">Usage</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="cllpsbl-icn" viewBox="0 0 24 24">
                            <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
                        </svg>
                    </div>
                    <ul class="lst-itm cntnt_wrpr">
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Basic Usage</span>
                            </div>
                        </li>
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Generating Specific Stats</span>
                            </div>
                        </li>
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Displaying Multiple Stats</span>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="mnu_lst-itm_wrpr">
                    <div class="lst-itm lv1 collapsible">
                        <span class="sublst-ttl">Available Stats</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="cllpsbl-icn" viewBox="0 0 24 24">
                            <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
                        </svg>
                    </div>
                    <ul class="lst-itm cntnt_wrpr">
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Contribution Stats</span>
                            </div>
                        </li>
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Top Languages Stats</span>
                            </div>
                        </li>
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Repo Stats</span>
                            </div>
                        </li>
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Custom Stats</span>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="mnu_lst-itm_wrpr">
                    <div class="lst-itm lv1 collapsible">
                        <span class="sublst-ttl">API Documentation</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="cllpsbl-icn" viewBox="0 0 24 24">
                            <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
                        </svg>
                    </div>
                    <ul class="lst-itm cntnt_wrpr">
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible" lnk-act>
                                <span class="sublst-ttl">API Overview</span>
                            </div>
                        </li>
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Endpoints</span>
                            </div>
                        </li>
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">API Customization</span>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="mnu_lst-itm_wrpr">
                    <div class="lst-itm lv1 collapsible">
                        <span class="sublst-ttl">Examples</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="cllpsbl-icn" viewBox="0 0 24 24">
                            <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
                        </svg>
                    </div>
                    <ul class="lst-itm cntnt_wrpr">
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Basic Example</span>
                            </div>
                        </li>
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Complex Example with Multiple Stats</span>
                            </div>
                        </li>
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Real-life Project Example</span>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="mnu_lst-itm_wrpr">
                    <div class="lst-itm lv1 collapsible">
                        <span class="sublst-ttl">Contributing</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="cllpsbl-icn" viewBox="0 0 24 24">
                            <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
                        </svg>
                    </div>
                    <ul class="lst-itm cntnt_wrpr">
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">How to Contribute</span>
                            </div>
                        </li>
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Coding Standards</span>
                            </div>
                        </li>
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Pull Request Guidelines</span>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="mnu_lst-itm_wrpr">
                    <div class="lst-itm lv1 collapsible">
                        <span class="sublst-ttl">FAQ</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="cllpsbl-icn" viewBox="0 0 24 24">
                            <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
                        </svg>
                    </div>
                    <ul class="lst-itm cntnt_wrpr">
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Supported Stats</span>
                            </div>
                        </li>
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">How Often Are Stats Updated?</span>
                            </div>
                        </li>
                        <li class="mnu_lst-itm_wrpr">
                            <div class="lst-itm lv2 collapsible">
                                <span class="sublst-ttl">Can I Customize the API Response?</span>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<script>
    $(document).ready(() => {
        $(".lst-itm.lv1.collapsible").click(function() {
            const subMenuList = $(this).next();
            const $sdbrWrprScrlBrElmnt = $('.sdbr_wrpr');

            if ($(this).attr('act') !== undefined) {
                $(this).removeAttr('act');
                subMenuList.css('height', '0px');
            } else {
                $(this).attr('act', '');

                const subMenuListHeight = Array.from(subMenuList[0].children).reduce((acc, child) => {
                    return acc + child.clientHeight;
                }, 0);

                subMenuList.css('height', `calc(${subMenuListHeight}px + ${subMenuList[0].children.length} * .25rem)`);
            }

            setTimeout(() => {
                const hasScrollbar = $sdbrWrprScrlBrElmnt[0].scrollHeight > $sdbrWrprScrlBrElmnt.innerHeight();

                if (hasScrollbar) {
                    $('.doc-sdbr_wrpr').css('border-color', 'transparent');
                } else {
                    $('.doc-sdbr_wrpr').css('border-color', '#dadde1');
                }
            }, 200);
        });
    });
</script>
