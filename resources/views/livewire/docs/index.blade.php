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
        @livewire('docs.menu', [ 'actItmUrlSlug' => $urlSlug ])
        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
            @livewire('docs.page', ['actItmContentUrl' => $urlSlug])
        </div>
    </div>
</div>
<script>
    function reverseSlug(slug) {
        let reversedSlug = slug.replace(/-/g, ' ');

        reversedSlug = reversedSlug.replace(/\b\w/g, function(char) {
            return char.toUpperCase();
        });

        return reversedSlug;
    }

    document.addEventListener('livewire:initialized', function (e) {
        Livewire.on('showContent', (urlSlug) => {
            const slug = urlSlug[0].split(":::")[1];
            const newUrl = `${window.location.origin}/docs/${slug}`;
            history.pushState({ urlSlug: urlSlug }, '', newUrl);
            Livewire.dispatch('pageContent', urlSlug);
        });

        let urlSlugCache = {};

        let isPopStateEvent = false;
        window.addEventListener('popstate', function(event) {
            if (!isPopStateEvent && event.state && event.state.urlSlug) {
                const slug = event.state.urlSlug;
                if (urlSlugCache[urlSlug]) {
                    Livewire.dispatch('pageContent', urlSlug);
                } else {
                    Livewire.dispatch('showContent', urlSlug);
                }
                isPopStateEvent = true;
            }
        });

        Livewire.on('showContent', (urlSlug) => {
            fetchContentForSlug(urlSlug);
            isPopStateEvent = false;
        });

        function fetchContentForSlug(urlSlug) {
            const content = `${urlSlug}`;

            if (!urlSlugCache[urlSlug]) {
                urlSlugCache[urlSlug] = content;
            }
        }
        console.log(window.location.origin);
        Livewire.on('pageContent', (slug) => {
            const newTitle = document.querySelector('title');
            const newCanonical = document.querySelector('link[rel="canonical"]');
            const newDescription = document.querySelector('meta[name="description"]');
            const newDescriptionContent = reverseSlug(slug[0].split(":::")[1]);

            if (newTitle) {
                newTitle.innerText = `${slug[0].split(":::")[0]} | ${newDescriptionContent}`;
            }

            if (newDescription) {
                newDescription.setAttribute('content', `${newDescriptionContent}`);
            }

            if (newCanonical) {
                newCanonical.setAttribute('href', `${window.location.origin}/${slug[0].split(":::")[1]}`);
            }
        });
    });
</script>
