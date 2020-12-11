var passwordshower = document.querySelectorAll('.showpassword')
for (var i = 0; i < passwordshower.length; i++) {
    var parent = passwordshower[i].parentElement
    console.log(parent)
    passwordshower[i].onclick = function () {
        this.classList.toggle('fa-eye-slash')
        var type = parent.querySelector(".password").type
        parent.querySelector(".password").type = type == 'text' ? 'password' : 'text'
    }
    // passwordshower[i].addEventListener('click',() => {
    //     passwordshower[i].parentElement.querySelector('#password').type='text'
    //     passwordshower[i].classList.toggle('fa-eye-slash')
    // })
}

let checker = () => {
    if (document.querySelectorAll('.forms > form.active').length > 0) {
        document.querySelectorAll('.forms > form.active')[0].classList.remove('active')
    }
}

let toggler = (name) => {
    document.querySelector(`.${name}_form`).classList.toggle('active')
    document.querySelector(`.${name}_form`).querySelector("input[name='username']").focus()
}

var selectors = document.querySelectorAll('.selector')
var forms = document.querySelectorAll('.forms > form');

for (var i = 0; i < selectors.length; i++) {
    selectors[i].onclick = function () {
        if (document.querySelectorAll('.selector.active').length > 0) {
            document.querySelectorAll('.selector.active')[0].classList.remove('active')
        }
        this.classList.toggle('active')
        if (this.classList.contains('organization')) {
            checker()
            toggler('organization')
        }
        else if (this.classList.contains('investor')) {
            checker()
            toggler('investor')
        }
        else if (this.classList.contains('employee')) {
            checker()
            toggler('employee')
        }
    }
}

window.addEventListener('DOMContentLoaded', () => {
    let inputs = document.querySelectorAll("input[name='username']")
    inputs.forEach(input => {
        input.focus()
    })
})

