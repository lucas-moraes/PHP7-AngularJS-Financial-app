
window.addEventListener('load', function () {
    fetch('http://localhost/backend/view/get.php', { method: 'get', mode: 'no-cors' })
        .then(res => { return res.json(); })
        .then(data => {
            var html = data.movimentacao.map(function (element) {
                return (
                    `<div class="row ${ element.valor < 0 ? 'negativo' : 'positivo' }">` +
                    '<div class="col-1"><span>' + element.dia + '/' + element.mes + '/' + element.ano + '</span></div>' +
                    '<div class="col-2"><span>' + element.tipo + '</span></div>' +
                    '<div class="col-3"><span>' + element.categoria + '</span></div>' +
                    '<div class="col-4"><span>' + element.descricao + '</span></div>' +
                    '<div class="col-5"><a href="#"><img src="./assets/close.svg" /></a><a href="#"><img src="./assets/cog.svg" /></a></div>' +
                    '<div class="col-6"><span>' + "R$" + Number(element.valor).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.") + '</span></div>' +
                    '</div>'
                );
            }).join('');
            document.getElementById("items").innerHTML = html;
        });
});


function openTab (evt, tabName) {
    var i, tabcontent, tabitem;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++)
    {
        tabcontent[ i ].style.display = "none";
    }
    tabitem = document.getElementsByClassName("tab-item");
    for (i = 0; i < tabitem.length; i++)
    {
        tabitem[ i ].className = tabitem[ i ].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += (" active");
}

