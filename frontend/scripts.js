

let listCategory = [];

window.addEventListener('load', function () {

    getMoviment();
    getCategories('option');
    getDate();
});

function getMoviment(){
    fetch('http://localhost/cloudcont/backend/view/GetMoviment.php', { method: 'get', mode: 'no-cors' })
        .then(res => { return res.json(); })
        .then(data => {
            var movimentacao = data.movimentacao.map(function (element) {
                return (
                    `<div class="row">` +
                    '<div class="col-1"><span>' + element.dia + '/' + element.mes + '/' + element.ano + '</span></div>' +
                    '<div class="col-2"><span>' + element.tipo + '</span></div>' +
                    '<div class="col-3"><span>' + element.categoria + '</span></div>' +
                    '<div class="col-4"><span>' + element.descricao + '</span></div>' +
                    '<div class="col-5"><a href="#"><img src="./assets/close.svg" /></a><a href="#"><img src="./assets/cog.svg" /></a></div>' +
                    '<div class="col-6"><span>' + "R$" + Number(element.valor).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.") + '</span></div>' +
                    '</div>'
                );
            }).join('');
            document.getElementById("items").innerHTML = movimentacao;
            document.getElementById("sum").innerHTML = "R$" + Number(data.total).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.");
        });
}

function getCategories(tag){
    let categories1 = document.getElementById('categories1');
    let categories2 = document.getElementById('categories2');

    if(listCategory.length <= 0){
    fetch('http://localhost/cloudcont/backend/view/GetCategory.php', { method: 'get', mode: 'no-cors' })
        .then(res => { return res.json(); })
        .then(data => {
            listCategory = data.categoria;
            switch (tag) {
                case 'option':
                    categoria = data.categoria.map(function (item) {
                        return (
                            `<option>` + item.nome + `</option>`
                        );
                    }).join('');
                    categories1.innerHTML = categoria;
                    let option = document.createElement('option');
                    option.text = 'Selecione';
                    option.value = '';
                    option.selected = true;
                    let select = document.getElementById('categories1');
                    select.appendChild(option);
                    break;
                case 'span':
                    let categories = listCategory.map(function (element){
                        return(
                            '<div class="row" style="justify-content: space-between">' +
                                    '<span>'+
                                        element.nome +
                                    '</span>'+
                                    '<a href="#"><img src="./assets/close.svg"></a>'+
                            '</div>'            
                        )
                    }).join('');
                    document.getElementById("categories3").innerHTML = categories;
                    break;
            }
        });
    } else {
        switch (tag) {
            case 'option':
                categoria = listCategory.map(function (item) {
                    return (
                        `<option>` + item.nome + `</option>`
                    );
                }).join('');
                categories1.innerHTML = categoria;
                categories2.innerHTML = categoria;
                let option = document.createElement('option');
                option.text = 'Selecione';
                option.value = '';
                option.selected = true;
                let select1 = document.getElementById('categories1');
                select1.appendChild(option);
                let select2 = document.getElementById('categories2');
                select2.appendChild(option);
                break;
            case 'span':
                let categories = listCategory.map(function (element){
                    return(
                        '<div class="row" style="justify-content: space-between">' +
                                '<span>'+
                                    element.nome +
                                '</span>'+
                                '<a href="#"><img src="./assets/close.svg"></a>'+
                        '</div>'            
                    )
                }).join('');
                document.getElementById("categories3").innerHTML = categories;
                break;
        }
    }
}

function getDate(){
    document.getElementById('date').value = new Date().toISOString().substring(0, 10);
    fetch('http://localhost/cloudcont/backend/view/GetDate.php', { method: 'get', mode: 'no-cors' })
        .then(res => { return res.json(); })
        .then(data => {
            var listaMes = document.getElementById('mes');
            mes = data.mes.map(function (item) {
                return (
                    '<option>' + item.mes + '</option>'
                );
            }).join('');
            listaMes.innerHTML = mes;
            var option = document.createElement('option');
            option.text = 'Selecione';
            option.value = '';
            option.selected = true;
            var select = document.getElementById('mes');
            select.appendChild(option);

            var listaAno = document.getElementById('ano');
            ano = data.ano.map(function (item) {
                return (
                    '<option>' + item.ano + '</option>'
                );
            }).join('');
            listaAno.innerHTML = ano;
            var option = document.createElement('option');
            option.text = 'Selecione';
            option.value = '';
            option.selected = true;
            var select = document.getElementById('ano');
            select.appendChild(option);

        });

}

function insertMoviment(){
    let data = document.getElementById('date').value;

    console.log(data);
}

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
    document.getElementById(tabName).style.display = "flex";
    evt.currentTarget.className += (" active");
}

function fadeOut (id, time, display) {
    fade(id, time, 100, 0, display);
}

function fadeIn (id, time, display) {
    fade(id, time, 0, 100, display);
}

function fade (id, time, ini, fin, display) {
    var target = document.getElementById(id);
    var alpha = ini;
    var inc;
    if (fin >= ini)
    {
        inc = 2;
    } else
    {
        inc = -2;
    }
    timer = (time * 100) / 50;
    var i = setInterval(
        function () {
            if ((inc > 0 && alpha >= fin) || (inc < 0 && alpha <= fin))
            {
                clearInterval(i);
            }
            setAlpha(target, alpha, display);
            alpha += inc;
        }, timer);
}

function setAlpha (target, alpha, display) {
    target.style.filter = "alpha(opacity=" + alpha + ")";
    target.style.opacity = alpha / 100;
    switch (display)
    {
        case "none":
            target.style.display = "none";
            break;
        case "block":
            target.style.display = "block";
            break;
        case "flex":
            target.style.display = "flex";
            break;
    }

}

function moeda(number, dot, comma, event) {
    let n = "", h = j = 0, u = tamanho2 = 0, l = ajd2 = "", o = window.Event ? event.which : event.keyCode;
    if (13 == o || 8 == o){
        return !0;
    }
    if (n = String.fromCharCode(o), -1 == "0123456789".indexOf(n)){
        return !1;
    }
    for (u = number.value.length, h = 0; h < u && ("0" == number.value.charAt(h) || number.value.charAt(h) == comma); h++);
    for (l = ""; h < u; h++){
        -1 != "0123456789".indexOf(number.value.charAt(h)) && (l += number.value.charAt(h));
    }
    if (l += n, 0 == (u = l.length) && (number.value = ""), 1 == u && (number.value = "0" + comma + "0" + l), 2 == u && (number.value = "0" + comma + l), u > 2) {
        for (ajd2 = "", j = 0, h = u - 3; h >= 0; h--){
            3 == j && (ajd2 += dot,
            j = 0),
            ajd2 += l.charAt(h),
            j++;
        }
        for (number.value = "", tamanho2 = ajd2.length, h = tamanho2 - 1; h >= 0; h--){
            number.value += ajd2.charAt(h);
        }
        number.value += comma + l.substr(u - 2, u)
    }
    return !1
}

