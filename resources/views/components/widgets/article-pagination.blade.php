<div class="flex justify-between items-center">
        <div id="prev-article-btn" class="flex justify-between items-center cursor-pointer" onclick="nxtPrevArticle('prev')">
            <span class="inline-block">
                <svg width="24" height="24" class="mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM12 20C16.42 20 20 16.42 20 12C20 7.58 16.42 4 12 4C7.58 4 4 7.58 4 12C4 16.42 7.58 20 12 20ZM12 11H16V13H12V16L8 12L12 8V11Z" fill="black"/>
                </svg>
            </span>
            <span class="inline-block">Previous Article</span>
        </div>

        <div id="nxt-article-btn" class="flex justify-between items-center cursor-pointer" onclick="nxtPrevArticle('nxt')">
            <span class="inline-block">Next Article</span>
            <span class="inline-block">
                <svg width="24" height="24" class="ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM12 11H8V13H12V16L16 12L12 8V11Z" fill="black"/>
                </svg>
            </span>
        </div>
</div>

<script>
    const totalArticles = parseInt({{Js::from($totalArticles)}});
    const baseUrl = {{Js::from($baseUrl)}};
    const searchParams = new URLSearchParams(window.location.search);
    const hasPageParam = searchParams.has('page');
    const page = parseInt(searchParams.get('page'));

    if(page == totalArticles || totalArticles  == 1) document.getElementById("nxt-article-btn").style.display = "none"
    if(page > 1) document.getElementById("prev-article-btn").style.display = "block"

    function nxtPrevArticle(nxt_pre) {
        let url;
        if(hasPageParam) {
            if(nxt_pre === "nxt") nextPage = page + 1;
            else nextPage = page - 1;
            if(nextPage > totalArticles) return;
            url =  baseUrl +"?page="+ nextPage;
        } else url = baseUrl +"?page=2"

         location.href = url;
    }

</script>
