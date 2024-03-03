const tableButtons = document.querySelectorAll('.table-buttons');
const tableTbody = document.querySelectorAll('.table-container table tbody');
const tableTbodyTr = document.querySelectorAll('.table-container table tbody tr');

let isElementAppendedMobile = false;
const databaseDataArray = [];

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index_data.php', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var databaseData = JSON.parse(xhr.responseText);
            
            databaseData.forEach(function(data) {
                databaseDataArray.push(data);
            })

            function appendTableElementsForMobile() {

                tableTbody.forEach(function(tbody, index) {
                    const tr = document.createElement('tr');
                    const td = document.createElement('td');
                    const button1 = document.createElement('button');
                    const button2 = document.createElement('button');
                    const hyperlink1 = document.createElement('a');
                    const hyperlink2 = document.createElement('a');
            
                    const data = databaseDataArray[index];
            
                    button1.textContent = "Edit";
                    button2.textContent = "Delete";
                    
                    hyperlink1.append(button1);
                    hyperlink2.append(button2);
            
                    td.append(hyperlink1);
                    td.append(hyperlink2);
            
                
                    hyperlink1.setAttribute("href", "edit-page.php?id="+ data.id);
                    hyperlink2.setAttribute("href", "delete.php?id=" + data.id);
            
                    td.setAttribute("class", "table-buttons");
                    td.setAttribute("colspan", 2);
            
                    tr.setAttribute("class", "added-buttons");
                    tr.append(td);
                    tbody.append(tr);
                });
        
            isElementAppendedMobile = true;
        }
        
        function handleScreenSizeChange() {
            const screenWidth = window.innerWidth;
        
            const specificSize = 600; // Change this to your desired size
        
        
            if (screenWidth < specificSize && !isElementAppendedMobile) {
                const tableButtons = document.querySelectorAll('.table-buttons');
                tableButtons.forEach(function(element) {
                    element.remove();
                });
        
                appendTableElementsForMobile();
            } else if (screenWidth >= specificSize && isElementAppendedMobile) {
                const addedButtons = document.querySelectorAll('.added-buttons');
        
                isElementAppendedMobile = false;
        
                addedButtons.forEach(function(tbody) {
                    tbody.remove();
                });
        
                tableTbodyTr.forEach(function(tbody, index){
                const td = document.createElement('td');
                const button1 = document.createElement('button');
                const button2 = document.createElement('button');
                const hyperlink1 = document.createElement('a');
                const hyperlink2 = document.createElement('a');
        
                const data = databaseDataArray[index];
        
                button1.textContent = "Edit";
                button2.textContent = "Delete";
        
                hyperlink1.append(button1);
                hyperlink2.append(button2);
        
                td.append(hyperlink1);
                td.append(hyperlink2);
        
                hyperlink1.setAttribute("href","edit-page.php?id="+ data.id);
                hyperlink2.setAttribute("href","delete.php?id=" + data.id);
        
                td.setAttribute("class", "table-buttons");
        
                tbody.append(td);
                });
               
            };
          };
        
        window.addEventListener('resize', handleScreenSizeChange);
          
        handleScreenSizeChange();
        };
    };

    xhr.send();
    setTimeout(function(){
        console.log('databaseDataArray:',databaseDataArray);
    }, 300);

