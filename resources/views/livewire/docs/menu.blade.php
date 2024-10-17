@php
    use Illuminate\Support\Str;

    $menuDt = $data['menuData'];
    $actItmUrlSlug = $data['actItmUrlSlug'];
@endphp
<div class="doc-sdbr_wrpr">
    <div class="sdbr_wrpr">
        <nav class="menu">
            <ul class="mnu_lst_wrpr">
                @foreach ($menuDt->menu as $menuItm)
                    <li class="mnu_lst-itm_wrpr">
                        <div class="lst-itm lv1 collapsible"
                            @foreach ($menuItm->subItems as $subItm)
                                @if (Str::slug($subItm->title) === $actItmUrlSlug)
                                    act
                                    lnk-act
                                @endif
                            @endforeach
                        >
                            <span class="sublst-ttl">{{ $menuItm->title }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="cllpsbl-icn" viewBox="0 0 24 24">
                                <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
                            </svg>
                        </div>
                        <ul class="lst-itm cntnt_wrpr"
                            @foreach ($menuItm->subItems as $subItm)
                                @if (Str::slug($subItm->title) === $actItmUrlSlug)
                                    style="height: auto !important;"
                                @endif
                            @endforeach
                        >
                            @foreach ($menuItm->subItems as $subItm)
                                <li class="mnu_lst-itm_wrpr">
                                    <a
                                        class="lst-itm lv2 collapsible"
                                        wire:click.prevent="activeMnuItm('{{ $menuItm->title }}', '{{ Str::slug($subItm->title) }}')"
                                        href="{{ Str::slug($subItm->title) }}"
                                        @if (Str::slug($subItm->title) === $actItmUrlSlug)
                                            lnk-act
                                        @endif
                                    >
                                        <span class="sublst-ttl">{{ $subItm->title }}</span>
                                     </a>
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
