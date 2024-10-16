@php
    $menuDt = $data['menuData'];
@endphp
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
                @foreach ($menuDt->menu as $menuItm)
                    <li class="mnu_lst-itm_wrpr">
                        <div class="lst-itm lv1 collapsible">
                            <span class="sublst-ttl">{{ $menuItm->title }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="cllpsbl-icn" viewBox="0 0 24 24">
                                <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
                            </svg>
                        </div>
                        <ul class="lst-itm cntnt_wrpr">
                            @foreach ($menuItm->subItems as $subItm)
                                <li class="mnu_lst-itm_wrpr">
                                    <div class="lst-itm lv2 collapsible">
                                        <span class="sublst-ttl">{{ $subItm->title }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
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

        $('.lst-itm.lv2.collapsible').click(function(e) {
            const closestUl = $(e.currentTarget).closest('ul')[0];
            const closestLv1Collapsible = closestUl.nextSibling.parentElement.children[0];

            if ($(closestLv1Collapsible).attr('lnk-act') !== undefined) {
                if ($(this).attr('lnk-act') !== undefined) {
                    return;
                }

                $('.lst-itm.lv2.collapsible').removeAttr('lnk-act');
                $(this).attr('lnk-act', '');
            } else {
                $('.lst-itm.lv1.collapsible').removeAttr('lnk-act');
                $('.lst-itm.lv2.collapsible').removeAttr('lnk-act');
                $(closestLv1Collapsible).attr('lnk-act', '');
                $(this).attr('lnk-act', '');
            }
        });
    });
</script>
