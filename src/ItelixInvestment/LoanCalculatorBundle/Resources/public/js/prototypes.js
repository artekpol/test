var FormDataSender = function(formSelector, responsePlaceholder){
    this.formSelector = formSelector;
    this.responsePlaceholder = responsePlaceholder;
    this.run = function(){
        $(formSelector).on('click', '[type="submit"]', function(event){
            event.preventDefault();
            $.ajax({
                type: "POST",
                data: $(formSelector).serialize(),
                dataType: 'json',
                success: function(html){
                    $(responsePlaceholder).html(html);
                }
            });
        });
    };
}