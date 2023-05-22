<script>
    nbPages = 0;
    pageNum = 0;
    let pageSwitched = false
    
    function logout() {
        fetch('/logout', { method: "post" })
            .then( () => {
                document.location.href='/login'
            })
    }

    function previousPage() {
        if(pageNum == 0) return
        pageNum--

        pageSwitched = true
        search()
    }
        
    function nextPage() {
        if(pageNum + 1 > nbPages) return
        pageNum++
        
        pageSwitched = true
        search()
    }
</script>