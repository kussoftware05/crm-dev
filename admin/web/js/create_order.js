window.onload = function ()
{
    toggleShippingForm();
}

function toggleShippingForm()
{
    document.getElementById('s_same_as_b').addEventListener('click',()=>{
        if ( this.checked ) {
            // if checked ...
            console.log( this.value );
        } else {
            console.log('not checkd');
        }
    });

}