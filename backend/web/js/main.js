// $(function openPopUp(modalButton, modalBody, modalContent){
//     $(modalButton).click(function(){
//         $(modalBody).modal('show')
//             .find(modalContent)
//             .load($(this).attr('value'));
//     })
// });
$(function(){
    $('#ordersModalButton').click(function(){
        $('#ordersModal').modal('show')
            .find('#ordersModalContent')
            .load($(this).attr('value'));
    })
});
