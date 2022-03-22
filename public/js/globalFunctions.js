function deleteRecord(id, name){
    if(!confirm("Are you sure you want to delete "+ name +"? This cannot be undone.")) {
      return false;
    }
    document.getElementById("form-delete-" + id).submit();
  }