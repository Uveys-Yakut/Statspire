<style>
    .docs-doc-page_wrpr {
        width: 100%;
        height: 100%;
        display: flex;
        overflow-y: auto;
    }
    .doc-page_wrpr {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: row;
    }
</style>
<div class='docs-doc-page_wrpr'>
    <div class='doc-page_wrpr'>
        @livewire('docs.menu', ['activeMenuSlung' => $activeSlug])
        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
            @livewire('docs.page', ['mainContent' => $activeSlug])
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:initialized', function () {
        Livewire.on('showContent', (slug) => {
            const newUrl = `${window.location.origin}/docs/${slug}`;
            history.pushState({ slug: slug }, '', newUrl);
            console.log(slug);
            Livewire.dispatch('pageContent', slug);
        });

        let slugCache = {};

        window.addEventListener('popstate', function(event) {
            if (event.state && event.state.slug) {
                const slug = event.state.slug;

                if (slugCache[slug]) {
                    updateContent(slugCache[slug]);
                } else {
                    Livewire.dispatch('showContent', slug);
                }
            }
        });

        Livewire.on('showContent', (slug) => {
            fetchContentForSlug(slug);
        });

        function fetchContentForSlug(slug) {
            const content = `${slug}`;

            if (!slugCache[slug]) {
                slugCache[slug] = content;
            }

            updateContent(content);
        }

        function updateContent(content) {
            console.log(content);
        }
    });
</script>
