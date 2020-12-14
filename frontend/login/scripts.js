
window.addEventListener('load', function () {
    fetch('./address.php')
        .then(res => {return res.json()})
        .then(data => console.log(data))
});

