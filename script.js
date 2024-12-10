function collision_s1() {
for (var i=0; i<document.querySelector('#first_select').length; i++) {
    if (document.querySelector('#second_select').options[i].getAttribute("disabled") == "disabled"){
        document.querySelector('#second_select').options[i].removeAttribute("disabled");
    }
}

var value_select_one = document.querySelector('#first_select').value;
document.querySelector('#second_select > option[value='+value_select_one+']').setAttribute("disabled", "disabled");
}

function collision_s2() {
for (var i=0; i<document.querySelector('#second_select').length; i++) {
    if (document.querySelector('#first_select').options[i].getAttribute("disabled") == "disabled") {
        document.querySelector('#first_select').options[i].removeAttribute("disabled");
    }
}

var value_select_two = document.querySelector('#second_select').value;
document.querySelector('#first_select > option[value='+value_select_two+']').setAttribute("disabled", "disabled");
}

function swap_select() {
    var index_select_one = document.querySelector('#first_select').selectedIndex;
    var index_select_two = document.querySelector('#second_select').selectedIndex;
    
    document.querySelector('#first_select').selectedIndex = index_select_two;
    document.querySelector('#second_select').selectedIndex = index_select_one;

    collision_s1();
    collision_s2();
}

function remove_dot_at_the_end() {
    var start_value_value = document.querySelector('#start_value').value;
    var start_value_length = document.querySelector('#start_value').value.length;

    if((start_value_value.substring(((start_value_length)-1), start_value_length))===".") {
        document.querySelector('#submit_form').disabled = true;
    }
}

function validate_button_disable() {
    if(document.querySelector('#start_value').value==="") {
            document.querySelector('#submit_form').disabled = true; 
        } else if (!(document.querySelector('#start_value').value==="")) { 
            document.querySelector('#submit_form').disabled = false;

            if(document.querySelector('#first_select').value==="") { 
                document.querySelector('#submit_form').disabled = true; 
            } else if (!(document.querySelector('#first_select').value==="")){ 
                document.querySelector('#submit_form').disabled = false;

                if(document.querySelector('#second_select').value==="") { 
                    document.querySelector('#submit_form').disabled = true; 
                } else if (!(document.querySelector('#second_select').value==="")){ 
                    document.querySelector('#submit_form').disabled = false;
                }
            }
        }

    if(document.querySelector('#first_select').value==="") { 
        document.querySelector('#submit_form').disabled = true; 
    } else if (!(document.querySelector('#first_select').value==="")){ 
        document.querySelector('#submit_form').disabled = false;

        if(document.querySelector('#start_value').value==="") {
            document.querySelector('#submit_form').disabled = true; 
        } else if (!(document.querySelector('#start_value').value==="")) { 
            document.querySelector('#submit_form').disabled = false;

            if(document.querySelector('#second_select').value==="") { 
                document.querySelector('#submit_form').disabled = true; 
            } else if (!(document.querySelector('#second_select').value==="")){ 
                document.querySelector('#submit_form').disabled = false;
            }
        }

    }

    if(document.querySelector('#second_select').value==="") { 
        document.querySelector('#submit_form').disabled = true; 
    } else if (!(document.querySelector('#second_select').value==="")){ 
        document.querySelector('#submit_form').disabled = false;

        if(document.querySelector('#start_value').value==="") {
            document.querySelector('#submit_form').disabled = true; 
        } else if (!(document.querySelector('#start_value').value==="")) { 
            document.querySelector('#submit_form').disabled = false;

            if(document.querySelector('#first_select').value==="") { 
                document.querySelector('#submit_form').disabled = true; 
            } else if (!(document.querySelector('#first_select').value==="")){ 
                document.querySelector('#submit_form').disabled = false;
            }
        }
        
    }
}

function start_func() {
    validate_button_disable();
    remove_dot_at_the_end();
}

function select_1() {
    collision_s1();
    validate_button_disable();
    remove_dot_at_the_end();
}

function select_2() {
    collision_s2();
    validate_button_disable();
    remove_dot_at_the_end();
}

function active_tile() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const parameter = urlParams.get('type');

    document.querySelector('.'+ parameter + '_tile').classList.add('active_conversion_tile');
}

function back_home() {
    window.location.replace("index.php");
}

function back_type(go_to) {
    window.location.replace("index.php?type="+go_to);
}

