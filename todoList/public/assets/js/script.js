// Function to allow drop
function allowDrop(event) {
    event.preventDefault();
  }
  
  // Function to handle drag
  function drag(event) {
    event.dataTransfer.setData("text/plain", event.target.id);
  }
  
  // Function to handle drop
  function drop(event) {
    event.preventDefault();
    var itemId = event.dataTransfer.getData("text/plain");
    var targetElement = event.target;
  
    // Find the nearest parent element with the class 'task'
    while (!targetElement.classList.contains('task')) {
      targetElement = targetElement.parentElement;
      if (!targetElement) return; // Exit if no task element found
    }
  
    // Clone the dragged item
    var draggedItem = document.getElementById(itemId).cloneNode(true);
  
    // Append the cloned item to the target element
    targetElement.appendChild(draggedItem);
  }
  
  // Add event listeners to draggable elements
  var draggables = document.querySelectorAll('.itemfromlist');
  draggables.forEach(function (draggable) {
    draggable.addEventListener('dragstart', drag);
  });
  
  // Add event listener to dropzone elements
  var dropzones = document.querySelectorAll('.enabled_item');
  dropzones.forEach(function (dropzone) {
    dropzone.addEventListener('drop', drop);
    dropzone.addEventListener('dragover', allowDrop);
  });
  