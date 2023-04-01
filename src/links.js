document.addEventListener( 'DOMContentLoaded', function() {
  let addInputButton = document.getElementById( 'btn-add-inputs-links' );
  let inputsContainer = document.getElementById( 'links-input' );

  addInputButton.addEventListener( 'click', function() {
      inputsContainer.insertAdjacentHTML("beforeend",`
      <label> add new link</label><br />
      <label> title link</label>
      <input type="text" name="title[]">
      <label> Link</label>
      <input type="text" name="link[]"><br />
      `)
  } );
} );