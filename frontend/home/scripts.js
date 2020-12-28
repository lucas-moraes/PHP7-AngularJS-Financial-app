let monthTranslation = {
    '1':'janeiro',
    '2':'fevereiro',
    '3':'março',
    '4':'abril',
    '5':'maio',
    '6':'junho',
    '7':'julho',
    '8':'agosto',
    '9':'setembro',
    '10':'outubro',
    '11':'novembro',
    '12':'dezembro'
}

let listCategory = [];

let d = new Date();
let mesAtual = d.getMonth() + 1;
let anoAtual = d.getFullYear(); 

window.addEventListener('load', function () {
    let d = new Date();
    let mes = d.getMonth() + 1;
    let ano = d.getFullYear(); 

    getMoviment();
    getCategories('start');
    getDate();
    if(mesAtual && anoAtual){
        getGroup(mesAtual, anoAtual);
    }    
});

function filterMoviment(){
    let categories = document.getElementById('categories1').value;
    let month = document.getElementById('mes').value;
    let year = document.getElementById('ano').value;

    getGroup(month, year);

    let formdata = new FormData();
    formdata.append("category", categories);
    formdata.append("month", month);
    formdata.append("year", year);

    let requestOptions = {
        method: 'POST',
        body: formdata,
        mode: 'no-cors',
        redirect: 'follow'
    };

    fetch("../../backend/view/MovimentFilter.php", requestOptions)
        .then(response => { return response.json()} )
        .then(data => {
            if(data){
                var movimentacao = data.moviment.map(function (element) {
                    return (
                        `<div class="row ${element.valor > 0 ? "positivo" : "negativo"} "/>` +
                        '<div class="col-1"><span>' + element.dia + '/' + element.mes + '/' + element.ano + '</span></div>' +
                        '<div class="col-2"><span>' + element.tipo + '</span></div>' +
                        '<div class="col-3"><span>' + element.categoria + '</span></div>' +
                        '<div class="col-4"><span>' + element.descricao + '</span></div>' +
                        `<div class="col-5"><a href="#" onclick="deleteMoviment(${element.id})"><img src="../assets/close.svg" /></a><a href="#" onclick="movimentGetById(${element.id}); getCategories('option'); fadeOut('screen_movimentation', 0.5, 'none'); fadeIn('screen_register', 0.5, 'flex');"><img src="../assets/cog.svg" /></a></div>` +
                        '<div class="col-6"><span>' + "R$ " + Number(element.valor).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.") + '</span></div>' +
                        '</div>'
                    );
                }).join('');
                document.getElementById("items").innerHTML = movimentacao;
                document.getElementById("sum").innerHTML = "R$ " + Number(data.total).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.");
                resetFilterButton('reset');
            }
            document.getElementById('resumoMes').innerHTML = `<span>`+translateMonth(data.moviment[0].mes)+`</span>`;
        })
        .catch(error => console.log('error', error));
}

function getMoviment(){
    fetch('../../backend/view/MovimentGet.php', { method: 'get', mode: 'no-cors' })
        .then(res => { return res.json(); })
        .then(data => {
            var movimentacao = data.movimentacao.map(function (element) {
                return (
                    `<div class="row ${element.valor > 0 ? "positivo" : "negativo"} "/>` +
                    '<div class="col-1"><span>' + element.dia + '/' + element.mes + '/' + element.ano + '</span></div>' +
                    '<div class="col-2"><span>' + element.tipo + '</span></div>' +
                    '<div class="col-3"><span>' + element.categoria + '</span></div>' +
                    '<div class="col-4"><span>' + element.descricao + '</span></div>' +
                    `<div class="col-5"><a href="#" onclick="deleteMoviment(${element.id})"><img src="../assets/close.svg" /></a><a href="#" onclick="movimentGetById(${element.id}); getCategories('option'); fadeOut('screen_movimentation', 0.5, 'none'); fadeIn('screen_register', 0.5, 'flex');"><img src="../assets/cog.svg" /></a></div>` +
                    '<div class="col-6"><span>' + "R$ " + Number(element.valor).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.") + '</span></div>' +
                    '</div>'
                );
            }).join('');
            document.getElementById("items").innerHTML = movimentacao;
            document.getElementById("sum").innerHTML = `<span class="${data.total > 0 ? "positivo" : "negativo"}">` +"R$ " + Number(data.total).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.")+'</span>';
            document.getElementById('resumoMes').innerHTML = `<span>`+translateMonth(data.movimentacao[0].mes)+`</span>`;
        });
}

function resetMoviment(){
    document.getElementById('categories1').value = '';
    document.getElementById('mes').value = '';
    document.getElementById('ano').value = '';
    getMoviment();
    getGroup(mesAtual, anoAtual);
    resetFilterButton('filter');
}

function setMoviment(id){
    let date = document.getElementById('date').value; 
    let categories = document.getElementById('categories2').value;
    let type = document.getElementById('type').value;
    let description = document.getElementById('description').value;
    let value = document.getElementById('value').value;
    
    const myHeaders = new Headers();
    myHeaders.append("Accept", "application/json");
    myHeaders.append("Content-Type", "application/json");

    let formdata = new FormData();
    formdata.append("id", id);
    formdata.append("date", date);
    formdata.append("type", type);
    formdata.append("category", categories);
    formdata.append("description", description);
    formdata.append("value", value);

    let requestOptions = {
        method: 'POST',
        mode: 'no-cors',
        headers: myHeaders,
        body: formdata,
        redirect: 'follow'
    };

    fetch("../../backend/view/MovimentSet.php", requestOptions)
        .then(
            () => {          
                if(document.getElementById('categories1').value 
                    || document.getElementById('mes').value 
                    || document.getElementById('ano').value){
                        filterMoviment();
                } else {
                    getMoviment();
                }},
            getCategories('start'),
            setButton('reg', 0),
            fadeOut('screen_register',0.5, 'none'),
            fadeIn('screen_movimentation', 0.5, 'block')
        )
        .catch(error => console.log('error', error));
}

function movimentGetById(id){
    let formdata = new FormData();
    formdata.append("id", id);

    let requestOptions = {
    method: 'POST',
    body: formdata,
    redirect: 'follow'
    };

    fetch("../../backend/view/MovimentGetById.php", requestOptions)
        .then(res => res.json())
        .then(data => {
            document.getElementById('date').value = `${data.ano}-${data.mes < 10 ? ('0' + data.mes) : (data.mes)}-${data.dia < 10 ? ('0' + data.dia) : (data.dia)}`;
            document.getElementById('categories2').value = data.categoria;
            document.getElementById('type').value = data.tipo;
            document.getElementById('description').value = data.descricao;
            document.getElementById('value').value = Number(data.valor).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.");
        })
        setButton('set', id)
}

function registerMoviment(){
    let date = document.getElementById('date').value; 
    let categories = document.getElementById('categories2');
    categories = categories.options;
    let categoryId = categories[categories.selectedIndex].value;
    let type = document.getElementById('type');
    type = type.options;
    let typeId = type[type.selectedIndex].value;
    let description = document.getElementById('description').value;
    let value = document.getElementById('value').value;

    console.log(date, categories, type, typeId, description, value);

    const myHeaders = new Headers();
    myHeaders.append("Accept", "application/json");
    myHeaders.append("Content-Type", "application/json");
    
    let formdata = new FormData();
    formdata.append("date", date);
    formdata.append("type", typeId);
    formdata.append("category", categoryId);
    formdata.append("description", description);
    formdata.append("value", value);

    let requestOptions = {
      method: 'POST',
      mode: 'no-cors',
      headers: myHeaders,
      body: formdata,
      redirect: 'follow'
    };
    
    fetch("../../backend/view/MovimentReg.php", requestOptions)
      .then(() => {
          if(document.getElementById('categories1').value 
            || document.getElementById('mes').value 
            || document.getElementById('ano').value){
                filterMoviment();
            } else {
                getMoviment();
            }},
          fadeOut('screen_register',0.5, 'none'), 
          fadeIn('screen_movimentation', 0.5, 'block')
        )
      .catch(error => console.log('error', error));
}

function resetFilterButton(arg){
    switch(arg){
        case 'filter':
            document.getElementById('filterButton').innerHTML = '<li class="button" id="filterButton" style="float: right;" onclick="filterMoviment()"><a class="tab-links" href="#">Filter</a></li>';
            break;
        case 'reset':
            document.getElementById('filterButton').innerHTML = '<li class="button" id="filterButton" style="float: right;" onclick="resetMoviment()"><a class="tab-links" href="#">Resetar</a></li>';
            break
    }
}

function setButton(arg, id){
    switch (arg) {
        case 'set':
            document.getElementById('setButton').innerHTML = `<li id="setButton" class="button" style="margin-top: 15px;" onclick="setMoviment(${id})"><a class="tab-links">Alterar</a></li>`;
            break;
        case 'reg':
            document.getElementById('setButton').innerHTML = '<li id="setButton" class="button" style="margin-top: 15px;" onclick="registerMoviment()"><a class="tab-links">Registrar</a></li>';
            break; 
    }
}

function deleteMoviment(id){
    let formdata = new FormData();
    formdata.append("id", id);

    let requestOptions = {
        method: 'POST',
        body: formdata,
        redirect: 'follow'
    };

    fetch("../../backend/view/MovimentDel.php", requestOptions)
        .then(
            ()=> {  if(document.getElementById('categories1').value 
                        || document.getElementById('mes').value 
                        || document.getElementById('ano').value){
                            filterMoviment();
                        } else {
                            getMoviment();
            }})
        .catch(error => console.log('error', error));
}

function getCategories(tag){
    let categories1 = document.getElementById('categories1');
    let categories2 = document.getElementById('categories2');
    let categories3 = document.getElementById("categories3");

    switch (tag) {
        case 'option':
            categoria = listCategory.map(function (item) {
                return (
                    `<option value="${item.id}">` + item.nome + `</option>`
                );
            }).join('');
            categories2.innerHTML = categoria;
            let option = document.createElement('option');
            option.text = 'Selecione';
            option.value = '';
            option.selected = true;
            categories2.appendChild(option);
            break;
        case 'span':
            let categories = listCategory.map(function (element){
                return(
                    '<div class="row" style="justify-content: space-between">' +
                            '<span>'+
                                element.nome +
                            '</span>'+
                            `<a href="#" onclick="deleteCategory(${element.id})"><img src="../assets/close.svg"></a>`+
                    '</div>'            
                )
            }).join('');
            categories3.innerHTML = categories;
            break;
        case 'start':
            fetch('../../backend/view/CategoryGet.php', { method: 'get', mode: 'no-cors' })
                .then(res => { return res.json(); })
                .then(data => {
                    listCategory = data.categoria;
                    
                    let categoria = listCategory.map(function (item) {
                        return (
                            `<option value="${item.id}">` + item.nome + `</option>`
                        );
                    }).join('');
                    categories1.innerHTML = categoria;
                    let option = document.createElement('option');
                    option.text = 'Selecione';
                    option.value = '';
                    option.selected = true;
                    categories1.appendChild(option);

                    let categories = listCategory.map(function (element){
                        return(
                            '<div class="row" style="justify-content: space-between">' +
                                    '<span>'+
                                        element.nome +
                                    '</span>'+
                                    `<a href="#" onclick="deleteCategory(${element.id})"><img src="../assets/close.svg"></a>`+
                            '</div>'            
                        )
                    }).join('');
                    document.getElementById("categories3").innerHTML = categories;
                });    
            break;
    }
}

function registerCategory(){
    let category = document.getElementById("categoryDescription").value;
    let formdata = new FormData();
    formdata.append("description", category);

    let requestOptions = {
    method: 'POST',
    body: formdata,
    redirect: 'follow'
    };

    fetch("../../backend/view/CategoryReg.php", requestOptions)
        .then(getCategories('start'))
        .catch(error => console.log('error', error));
}

function deleteCategory(id){
    var formdata = new FormData();
    formdata.append("id", id);
    
    var requestOptions = {
      method: 'POST',
      body: formdata,
      redirect: 'follow'
    };
    
    fetch("../../backend/view/CategoryDel.php", requestOptions)
      .then(getCategories('start'))
      .catch(error => console.log('error', error));
}

function translateMonth(arg){
    return arg.replace(arg, x=>monthTranslation[x])
}

function getDate(){
    document.getElementById('date').value = new Date().toISOString().substring(0, 10);

    fetch('../../backend/view/DateGet.php', { method: 'get', mode: 'no-cors' })
        .then(res => { return res.json(); })
        .then(data => {
            var listaMes = document.getElementById('mes');
            mes = data.mes.map(function (item) {
                return (
                    `<option value="${item.mes}">` + translateMonth(item.mes) + '</option>'
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
                    `<option value="${item.ano}">` + item.ano + '</option>'
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

function getGroup(mes, ano){
    var formdata = new FormData();
    formdata.append("month", mes);
    formdata.append("year", ano);

    var requestOptions = {
        method: 'POST',
        body: formdata,
        mode: 'no-cors',
        redirect: 'follow'
    };

    fetch("../../backend/view/MovimentGetGroup.php", requestOptions)
        .then(res => { return res.json(); })
        .then(data => {
            let resumoMensal = data.resume.map(function(element) {
                return (
                    `<div class="lineGroup ${element.valor > 0 ? 'positivo' : 'negativo'}">`+
                        '<div class="col-6"><span>' + element.categoria + '</span></div>' +
                        '<div class="col-6"><span>' + "R$ " + Number(element.valor).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.") + '</span></div>' +
                    '</div>'
                    )
            } 
            ).join('');
            document.getElementById("resumeGroup").innerHTML = resumoMensal;
            document.getElementById("groupTotal").innerHTML  = `<div class="lineGroup ${data.totalResume > 0 ? 'positivo':'negativo'}">`+ '<div class="col-6"><span>Total</span></div>'+'<div class="col-6"><span>'+ 'R$ ' + Number(data.totalResume).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.") +'</span></div>' +'</div>'
        
            let mensalGroup  = data.groupMonth.map(function(item) {
                return  (
                    `<div class="lineGroup ${item.valor > 0 ? 'positivo' : 'negativo'}">`+
                        '<div class="col-6" style="justify-content: start"><span>'+
                            item.mes+' / '+item.ano+
                        '</span></div>'+
                        '<div class="col-6"><span>'+
                        "R$ " + Number(item.valor).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.")+
                        '</span></div>'+
                    '</div>'
                )
            }).join('');
            document.getElementById('mensalGroup').innerHTML = mensalGroup;
            
            let categoryGroup = data.categoriesByYear.map(function(value) {
                return (
                    `<div class="lineGroup ${value.valor > 0 ? 'positivo' : 'negativo'}">`+
                        '<div class="col-6"><span>' + value.categoria + '</span></div>' +
                        '<div class="col-6"><span>' + "R$ " + Number(value.valor).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.") + '</span></div>' +
                    '</div>'
                )
            }).join('');
            document.getElementById('categorieGroup').innerHTML = categoryGroup;
            document.getElementById("categorieTotal").innerHTML  = `<div class="lineGroup ${data.totalCategoriesByYear > 0 ? 'positivo':'negativo'}">`+ '<div class="col-6"><span>Total</span></div>'+'<div class="col-6"><span>'+ 'R$ ' + Number(data.totalCategoriesByYear).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.") +'</span></div>' +'</div>'
        });
}
