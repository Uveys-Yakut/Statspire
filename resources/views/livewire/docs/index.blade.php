<style>
    .docs-doc-page_wrpr {
        width: 100%;
        height: 100%;
        display: flex;
        overflow-y: auto;
    }
    .doc-page_wrpr {
        height: 100%;
    }
</style>
<div class='docs-doc-page_wrpr'>
    <div class='doc-page_wrpr'>
        <livewire:docs.menu />
    </div>
</div>
<script>
    $(document).ready(() => {
        const headerHeight = $('.hdr-mn_wrpr')[0].offsetHeight;
        $('.docs-doc-page_wrpr').css('height', `calc(100% - ${headerHeight}px)`);
    });
</script>
