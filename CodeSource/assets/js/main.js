if (document.getElementById('idNumberOfPosts') != null) {
    // appel ajax
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };
    fetch("index.php?uc=getAllPosts", requestOptions).then(function(response) {
            return response.json();
        })
        .then(function(myDatas) {
            document.getElementById('idNumberOfPosts').innerText = myDatas;
        })

}