var liners = document.querySelectorAll('.liner');
var divs = document.querySelectorAll('.payment_summaries > div')
window.addEventListener('DOMContentLoaded',() =>{
    liners.forEach(liner => {
    if(liner.parentElement.parentElement.classList.contains('transaction') ||
    liner.parentElement.parentElement.classList.contains('debit'))
    {
        liner.classList.add('eighty')
    }
    if(liner.parentElement.parentElement.classList.contains('credit')){
        liner.classList.add('ninety')
    }
})
divs.forEach(div => {
    div.classList.add('showme')
})
})

var General = document.querySelector('.gen')
var Incoming = document.querySelector('.inc')
var Outgoing = document.querySelector('.out')
var incomingTrans = document.querySelector('.transactions.incoming')
var outgoingTrans = document.querySelector('.transactions.outgoing')
var GeneralTrans = document.querySelector('.transactions.general')
General.addEventListener('click',()=>{
    Incoming.classList.remove('active')
    Outgoing.classList.remove('active')
    General.classList.add('active')
    incomingTrans.classList.remove('showing')
    outgoingTrans.classList.remove('showing')
    GeneralTrans.classList.add('showing')
})
Incoming.addEventListener('click',()=>{
    General.classList.remove('active')
    Outgoing.classList.remove('active')
    Incoming.classList.add('active')
    incomingTrans.classList.add('showing')
    outgoingTrans.classList.remove('showing')
    GeneralTrans.classList.remove('showing')
})
Outgoing.addEventListener('click',()=>{
    Incoming.classList.remove('active')
    General.classList.remove('active')
    Outgoing.classList.add('active')
    incomingTrans.classList.remove('showing')
    outgoingTrans.classList.add('showing')
    GeneralTrans.classList.remove('showing')
})


// fund wallet
var fundWalletBtn = document.querySelector('#fund_wallet')
var TransferUICBtn = document.querySelector('#transfer_uic')
var WithdrawFundsBtn = document.querySelector('#withdraw_funds')
var walletBackdrop = document.querySelector('.wallet_backdrop')
var walletForm = document.querySelector('.wallet_fund')
var uicTransferForm = document.querySelector('.uic_transfer')
var withdrawFundsForm = document.querySelector('.fund_withdraw')

fundWalletBtn.addEventListener('click',() => {
    walletBackdrop.classList.remove('not_visible')
    walletForm.classList.remove('not_visible')
    walletBackdrop.classList.add('visible')
    walletForm.classList.add('visible')
})
TransferUICBtn.addEventListener('click',() => {
    walletBackdrop.classList.remove('not_visible')
    uicTransferForm.classList.remove('not_visible')
    uicTransferForm.classList.add('visible')
    walletBackdrop.classList.add('visible')
})

WithdrawFundsBtn.addEventListener('click',() => {
    walletBackdrop.classList.remove('not_visible')
    withdrawFundsForm.classList.remove('not_visible')
    walletBackdrop.classList.add('visible')
    withdrawFundsForm.classList.add('visible')
})

walletBackdrop.addEventListener('click',() => {
    walletBackdrop.classList.remove('visible')
    walletForm.classList.remove('visible')
    withdrawFundsForm.classList.remove('visible')
    uicTransferForm.classList.remove('visible')
    walletBackdrop.classList.add('not_visible')
    walletForm.classList.add('not_visible')
    withdrawFundsForm.classList.add('not_visible')
    uicTransferForm.classList.add('not_visible')


})