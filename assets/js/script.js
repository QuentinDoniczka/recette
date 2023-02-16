window.addEventListener('load', function(event) {
    // Ouvrir menu
    var menu = document.getElementById("menu");
    if(menu) {
        var burger = document.getElementById("js-open-menu");
        burger.addEventListener('click', function() {
            menu.classList.add("show");
        })
        // Fermer menu
        var cross = document.getElementById("js-close-menu");
        cross.addEventListener('click',function(){
            menu.classList.remove("show");
        })
    }
    // Formulaire d'inscription
    var form_inscr = document.getElementById("form-register");
    if(form_inscr) {
        form_inscr.addEventListener("submit", function(e) {
            e.preventDefault();
            var fail = "";
            var errors = document.getElementById("errors");
            errors.innerHTML = "";
            var pseudo = document.getElementById("pseudo").value;
            // Test valeurs des inputs
            var mdp = document.getElementById("mdp").value;
            var c_mdp = document.getElementById("c_mdp").value;
            if(mdp !== c_mdp) {
                fail += "Mots de passes différents";
            }
            //TODO: ajouts de tests
            if(fail) {
                var div = document.createElement('div');
                div.innerHTML = fail;
                div.classList.add('msg-error');
                errors.appendChild(div);
            } else {
                const formData = new FormData(this);
                fetch('../../signin/form_signin.php?register=1', {
                    method: this.getAttribute("method"),
                    body: formData
                })
                .then((response) =>  response.json()
                .then((data) => {
                    if(data.status) {
                        window.location.href = location.origin+location.pathname+"?pseudo="+pseudo;
                    } else if(data.msg) {
                        var div = document.createElement('div');
                        div.innerHTML = data.msg;
                        div.classList.add('msg-error');
                        errors.appendChild(div);
                    }
                })
                )
            }
        });
    }
    // Formulaire de connexion
    var form_connect = document.getElementById("form-connect");
    if(form_connect) {
        form_connect.addEventListener("submit", function(e) {
            e.preventDefault();
            var errors = document.getElementById("errors");
            errors.innerHTML = "";

            const formData = new FormData(this);
            fetch('../../signin/form_signin.php', {
                method: this.getAttribute("method"),
                body: formData
            })
            .then((response) =>  response.json()
            .then((data) => {
                if(data.status) {
                    window.location.href = location.origin;
                } else if(data.msg) {
                    var div = document.createElement('div');
                    div.innerHTML = data.msg;
                    div.classList.add('msg-error');
                    errors.appendChild(div);
                }
            })
            )
        });
    }
    // Formulaire creation/modification recette
    var form_receipt = document.getElementById("form_receipt");
    if(form_receipt) {
        form_receipt.addEventListener("submit", function(e) {
            e.preventDefault();
            var errors = document.getElementById("errors");
            errors.innerHTML = "";
            const formData = new FormData(this);
            fetch('../../receipts/form_receipt.php', {
                method: this.getAttribute("method"),
                body: formData
            })
            .then((response) =>  response.json()
            .then((data) => {
                if(data.status) {
                    window.location.href = location.origin+location.pathname;
                } else if(data.msg) {
                    var div = document.createElement('div');
                    div.innerHTML = data.msg;
                    div.classList.add('msg-error');
                    errors.appendChild(div);
                }
            })
            )
        });
    }
    // Suppression recettes
    var btn_delete = document.getElementsByClassName("js-delete-receipt");
    var btns_delete = [].slice.call(btn_delete);
    if(btns_delete.length > 0) {
        btns_delete.forEach((btn) => {
            btn.addEventListener("click", function(e) {
                e.preventDefault();
                var msg = document.getElementById("msg");
                msg.innerHTML = "";
                var id_receipt = this.getAttribute("data-id");
                var item = document.getElementsByClassName("item-"+id_receipt);
                fetch('../../receipts/delete.php?delete='+id_receipt)
                .then((response) =>  response.json()
                .then((data) => {
                    var div = document.createElement('div');
                    div.innerHTML = data.msg;
                    if(data.status) {
                        div.classList.add('msg-success');
                        item[0].remove();
                    } else if(data.msg) {
                        div.classList.add('msg-error');
                    }
                    msg.appendChild(div);
                })
                )
            })
        });
    }

    //Modification rôles
    var inp_role = document.getElementsByClassName("js-role-admin");
    var inputs_role = [].slice.call(inp_role);
    if(inputs_role.length > 0) {
        inputs_role.forEach((inp) => {
            inp.addEventListener("change", function(e) {
            e.preventDefault();
            var msg = document.getElementById("msg");
            msg.innerHTML = "";
            var is_admin = this.checked;
            var id_user = this.getAttribute("data-id");
            fetch('../../assets/php/roles.php?is_admin='+is_admin+'&id_user='+id_user).then((response) => response.json()
            .then((data) => {
                var div = document.createElement('div');
                div.innerHTML = data.msg;
                if(data.status) {
                    div.classList.add('msg-success');
                } else if(data.msg) {
                    div.classList.add('msg-error');
                }
                msg.appendChild(div);
            })
            )
            })       
        })
    }

    //Changement de langue
    var btn_langs = document.querySelectorAll("footer button");
    var langs = [].slice.call(btn_langs);
    if(langs.length > 0) {
        langs.forEach((lang) => {
            lang.addEventListener("click", function(e) {
            e.preventDefault();
            var lng = this.getAttribute("data-lang");
            fetch('../../assets/php/traductions.php?lang='+lng);
            location.reload();
            })       
        })
    }

    // Ajout ingrédient 
    var add_ingredient = document.getElementById("add_ingredient");
    if(add_ingredient) {
        var list = document.getElementById("list-ingredients");
        var qte = document.getElementById("qte_ingred");
        var unit = document.getElementById("unit_ingred");
        var name = document.getElementById("name_ingred");
        add_ingredient.addEventListener("click", function(e) {
            e.preventDefault();
            if(name.value && qte.value && unit.value) {
                var _html = `
                <label>
                    <input checked='checked' type='checkbox' name='ingredients[]' value='${(name.value)?name.value:''}:${(qte.value)?qte.value:''}:${(unit.value)?unit.value:''}'/>
                    <span>${(qte.value)?qte.value:''} ${(unit.value)?unit.value:''} : ${(name.value)?name.value:''}</span>
                    <span class="delete_ingredient" title="Delete">X</span>
                </label>`
                list.innerHTML += _html;
                name.value = "";
                qte.value = "";
            }
        })
    }

    //Ajouter à ma wishlist
    var btn_wish = document.querySelectorAll(".js-wishlist");
    var btns_wish = [].slice.call(btn_wish);
    if(btns_wish.length > 0) {
        btns_wish.forEach((btn) => {
            btn.addEventListener("click", function(e) {
                e.preventDefault();
                var id_receipt = this.getAttribute("data-id");
                fetch('../../shopping-list.php?id_receipt='+id_receipt).then((response) => response.json()
                .then((data) => {
                    if(data.status) {
                        btn.innerHTML = data.msg;
                    } else {
                        console.log(data.msg)
                    }
                })
                )
            })       
        })
    }


});