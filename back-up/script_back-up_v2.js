    //POPUP ADD
    document.querySelector('.add-button').addEventListener("click", function() {
        document.querySelector('.popup').classList.add('active');
    }) ;

    document.querySelector('.popup .close-button').addEventListener("click", function() {
        document.querySelector('.popup').classList.remove('active');
    }) ;

    //POPUP DEDUCT
    document.querySelector('.deduct-button').addEventListener("click", function() {
        document.querySelector('.deduct').classList.add('active');
    }) ;

    document.querySelector('.deduct .close-button').addEventListener("click", function() {
        document.querySelector('.deduct').classList.remove('active');
    }) ;

    //POPUP UPDATE PRICE
    document.querySelector('.update-price-button').addEventListener("click", function() {
        document.querySelector('.update-price').classList.add('active');
    }) ;

    document.querySelector('.update-price .close-button').addEventListener("click", function() {
        document.querySelector('.update-price').classList.remove('active');
    }) ;

    //POPUP UPDATE MAIN INVESTMENT
    document.querySelector('.update-main_investment-button').addEventListener("click", function() {
        document.querySelector('.update-main_investment').classList.add('active');
    }) ;

    document.querySelector('.update-main_investment .close-button').addEventListener("click", function() {
        document.querySelector('.update-main_investment').classList.remove('active');
    }) ;


    //DETECT SCREEN SIZE

    const tableLogsInfo = document.querySelectorAll ('.table-logs-info');
    const tableLogsInfoThead = document.querySelectorAll ('.table-logs-info thead tr');
    const tableLogsInfoTbody = document.querySelectorAll ('.table-logs-info tbody tr');

    let isElementAppendedMobile = false;
    const databaseDataArray = [];

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_data.php', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var databaseData = JSON.parse(xhr.responseText);
            
            databaseData.forEach(function(data) {
                databaseDataArray.push(data);
            })

            function appendTableElementsForMobile() {

                tableLogsInfo.forEach(function(tbody, index) {
                    const generateThead = document.createElement('thead');
                    const generateTr = document.createElement('tr');
                    const generateTbody = document.createElement('tbody');
                    const generateTr2 = document.createElement('tr');
                    const generateButton = document.createElement('button');
                    const generatehyperlink = document.createElement('a');
                    const generateP = document.createElement('p');
                    
                    generateButton.innerText = "Delete";
                    generateButton.setAttribute("class", "logs-delete-button");
    
                    const data = databaseDataArray[index];
    
                    generatehyperlink.setAttribute("href", "delete_edit-page.php?id="+data.idlogs);
            
                    generatehyperlink.append(generateButton);
        
                    generateThead.append(generateTr);
                    generateTbody.append(generateTr2);
                    
                    const theadtd1 = document.createElement('td');
                    theadtd1.textContent = 'Current Price';
                    const theadtd2 = document.createElement('td');
                    theadtd2.textContent = 'Current Value';
                    const theadtd3 = document.createElement('td');
                    theadtd3.textContent = '';
    
                    const currentValue = parseFloat(data.numberlogs * data.pricelogs);
            
                    const tbodytd1 = document.createElement('td');
                    tbodytd1.textContent = '₱' + data.pricelogs;
                    const tbodytd2 = document.createElement('td');
                    generateP.setAttribute("class", "current-value")
                    generateP.textContent = '₱' + currentValue.toFixed(2);
                    tbodytd2.append(generateP);
                    const tbodytd3 = document.createElement('td');
                    tbodytd3.append(generatehyperlink);
            
                    generateTr.append(theadtd1);
                    generateTr.append(theadtd2);
                    generateTr.append(theadtd3);
            
                    generateTr2.append(tbodytd1);
                    generateTr2.append(tbodytd2);
                    generateTr2.append(tbodytd3);
        
                    generateThead.setAttribute("class", "added-thead");
                    generateTbody.setAttribute("class", "added-tbody");
        
                    tbody.append(generateThead);
                    tbody.append(generateTbody);
            
                });
            
            isElementAppendedMobile = true;
        }
    
        function handleScreenSizeChange() {
            const screenWidth = window.innerWidth;
    
            const centerSelectedCoin = document.querySelector('.center-selected-coin');
            const centerSelectedCoinActive = document.querySelector('.center-selected-coin-active');
            const tdCurrentValue = document.querySelectorAll('.current-value-td');
            const tdCurrentPrice = document.querySelectorAll('.current-price');
            const tdHeaderCurrentValue = document.querySelectorAll('.header-current-value');
            const tdHeaderCurrentPrice = document.querySelectorAll('.header-current-price');
            const tdLogsDeleteButton = document.querySelectorAll('.logs-delete-button-td');
    
            const addedTbody = document.querySelectorAll('.added-tbody');
            const addedThead = document.querySelectorAll('.added-thead');
    
            const addedbackTheadTd = document.querySelectorAll('.addedback-thead-td');
            const addedbackTbodyTd = document.querySelectorAll('.addedback-tbody-td');
    
            const specificSize = 770; // Change this to your desired size
    
          
            if (screenWidth < specificSize && !isElementAppendedMobile) {
    
                if (centerSelectedCoin) {
                    centerSelectedCoin.setAttribute("class", "center-selected-coin-active");
                }
            
                tdCurrentValue.forEach(function(element) {
                    element.remove();
                });
                tdCurrentPrice.forEach(function(element) {
                    element.remove();
                });
                tdHeaderCurrentValue.forEach(function(element) {
                    element.remove();
                });
                tdHeaderCurrentPrice.forEach(function(element) {
                    element.remove();
                });
                tdLogsDeleteButton.forEach(function(element) {
                    element.remove();
                });
    
                appendTableElementsForMobile();
    
                addedbackTheadTd.forEach(function(element) {
                    element.remove();
                });
    
                addedbackTbodyTd.forEach(function(element) {
                    element.remove();
                });
    
            } else if (screenWidth >= specificSize && isElementAppendedMobile) {
    
                if(centerSelectedCoinActive) {
                    centerSelectedCoinActive.setAttribute("class", "center-selected-coin");
                }
    
                isElementAppendedMobile = false;
    
                addedTbody.forEach(function(element) {
                    element.remove();
                }) ;
                addedThead.forEach(function(element) {
                    element.remove();
                }) ;
    
                tableLogsInfoThead.forEach(function(tbody) {
                    const theadTd1 = document.createElement('td');
                    theadTd1.textContent = 'Current Price';
                    const theadTd2 = document.createElement('td');
                    theadTd2.textContent = 'Current Value';
                    const theadTd3 = document.createElement('td');
                    theadTd3.textContent = '';
    
                    tbody.append(theadTd1);
                    tbody.append(theadTd2);
                    tbody.append(theadTd3);
    
                    theadTd1.setAttribute("class", "addedback-thead-td");
                    theadTd2.setAttribute("class", "addedback-thead-td");
                    theadTd3.setAttribute("class", "addedback-thead-td");
                }) 
    
                tableLogsInfoTbody.forEach(function(tbody, index) {
                    const generateButton = document.createElement('button');
                    const generateHyperlink = document.createElement('a');
                    const generateP = document.createElement('p');
    
                    generateButton.innerText = "Delete";
                    generateButton.setAttribute("class", "logs-delete-button");
    
                    const data = databaseDataArray[index];
    
                    generateHyperlink.setAttribute("href", "delete_edit-page.php?id="+data.idlogs);
    
                    generateHyperlink.append(generateButton);
    
                    const currentValue = parseFloat(data.numberlogs * data.pricelogs);
    
                    const tbodyTd1 = document.createElement('td');
                    tbodyTd1.textContent = '₱' + data.pricelogs;
                    const tbodyTd2 = document.createElement('td');
                    generateP.setAttribute("class", "current-value")
                    generateP.textContent = '₱' + currentValue.toFixed(2);
                    tbodyTd2.append(generateP);
                    const tbodyTd3 = document.createElement('td');
                    tbodyTd3.append(generateHyperlink);
    
                    tbody.append(tbodyTd1);
                    tbody.append(tbodyTd2);
                    tbody.append(tbodyTd3);
    
                    tbodyTd1.setAttribute("class", "addedback-tbody-td");
                    tbodyTd2.setAttribute("class", "addedback-tbody-td");
                    tbodyTd3.setAttribute("class", "addedback-tbody-td");
    
                }) 
    
            
            }
          }
        
        //window.addEventListener('resize', handleScreenSizeChange);
          
        //handleScreenSizeChange();
        };
    };

    /*xhr.send();
    setTimeout(function(){
        console.log('databaseDataArray:',databaseDataArray);
    }, 300); */

    const mediaQuery = window.matchMedia('(max-width: 768px)');

    function handleMobiletoDesktopChange(event) {

        tdCurrentPrice2 = document.querySelectorAll('.current-price');

        if (event.matches) {
            
            if (centerSelectedCoin) {
                centerSelectedCoin.setAttribute("class", "center-selected-coin-active");
            }
        
            tdCurrentValue.forEach(function(element) {
                element.remove();
            });
            tdCurrentPrice.forEach(function(element) {
                element.remove();
            });
            tdHeaderCurrentValue.forEach(function(element) {
                element.remove();
            });
            tdHeaderCurrentPrice.forEach(function(element) {
                element.remove();
            });
            tdLogsDeleteButton.forEach(function(element) {
                element.remove();
            });

            appendTableElementsForMobile();

            addedbackTheadTd.forEach(function(element) {
                element.remove();
            });

            addedbackTbodyTd.forEach(function(element) {
                element.remove();
            });

        } else if (screenWidth >= specificSize && isElementAppendedMobile) {

            if(centerSelectedCoinActive) {
                centerSelectedCoinActive.setAttribute("class", "center-selected-coin");
            }

            isElementAppendedMobile = false;

            addedTbody.forEach(function(element) {
                element.remove();
            }) ;
            addedThead.forEach(function(element) {
                element.remove();
            }) ;

            tableLogsInfoThead.forEach(function(tbody) {
                const theadTd1 = document.createElement('td');
                theadTd1.textContent = 'Current Price';
                const theadTd2 = document.createElement('td');
                theadTd2.textContent = 'Current Value';
                const theadTd3 = document.createElement('td');
                theadTd3.textContent = '';

                tbody.append(theadTd1);
                tbody.append(theadTd2);
                tbody.append(theadTd3);

                theadTd1.setAttribute("class", "addedback-thead-td");
                theadTd2.setAttribute("class", "addedback-thead-td");
                theadTd3.setAttribute("class", "addedback-thead-td");
            }) 

            tableLogsInfoTbody.forEach(function(tbody, index) {
                const generateButton = document.createElement('button');
                const generateHyperlink = document.createElement('a');
                const generateP = document.createElement('p');

                generateButton.innerText = "Delete";
                generateButton.setAttribute("class", "logs-delete-button");

                const data = databaseDataArray[index];

                generateHyperlink.setAttribute("href", "delete_edit-page.php?id="+data.idlogs);

                generateHyperlink.append(generateButton);

                const currentValue = parseFloat(data.numberlogs * data.pricelogs);

                const tbodyTd1 = document.createElement('td');
                tbodyTd1.textContent = '₱' + data.pricelogs;
                const tbodyTd2 = document.createElement('td');
                generateP.setAttribute("class", "current-value")
                generateP.textContent = '₱' + currentValue.toFixed(2);
                tbodyTd2.append(generateP);
                const tbodyTd3 = document.createElement('td');
                tbodyTd3.append(generateHyperlink);

                tbody.append(tbodyTd1);
                tbody.append(tbodyTd2);
                tbody.append(tbodyTd3);

                tbodyTd1.setAttribute("class", "addedback-tbody-td");
                tbodyTd2.setAttribute("class", "addedback-tbody-td");
                tbodyTd3.setAttribute("class", "addedback-tbody-td");

            }) 

        } else {

            if(centerSelectedCoinActive) {
                centerSelectedCoinActive.setAttribute("class", "center-selected-coin");
            }

            isElementAppendedMobile = false;

            addedTbody.forEach(function(element) {
                element.remove();
            }) ;
            addedThead.forEach(function(element) {
                element.remove();
            }) ;

            tableLogsInfoThead.forEach(function(tbody) {
                const theadTd1 = document.createElement('td');
                theadTd1.textContent = 'Current Price';
                const theadTd2 = document.createElement('td');
                theadTd2.textContent = 'Current Value';
                const theadTd3 = document.createElement('td');
                theadTd3.textContent = '';

                tbody.append(theadTd1);
                tbody.append(theadTd2);
                tbody.append(theadTd3);

                theadTd1.setAttribute("class", "addedback-thead-td");
                theadTd2.setAttribute("class", "addedback-thead-td");
                theadTd3.setAttribute("class", "addedback-thead-td");
            }) 

            tableLogsInfoTbody.forEach(function(tbody, index) {
                const generateButton = document.createElement('button');
                const generateHyperlink = document.createElement('a');
                const generateP = document.createElement('p');

                generateButton.innerText = "Delete";
                generateButton.setAttribute("class", "logs-delete-button");

                const data = databaseDataArray[index];

                generateHyperlink.setAttribute("href", "delete_edit-page.php?id="+data.idlogs);

                generateHyperlink.append(generateButton);

                const currentValue = parseFloat(data.numberlogs * data.pricelogs);

                const tbodyTd1 = document.createElement('td');
                tbodyTd1.textContent = '₱' + data.pricelogs;
                const tbodyTd2 = document.createElement('td');
                generateP.setAttribute("class", "current-value")
                generateP.textContent = '₱' + currentValue.toFixed(2);
                tbodyTd2.append(generateP);
                const tbodyTd3 = document.createElement('td');
                tbodyTd3.append(generateHyperlink);

                tbody.append(tbodyTd1);
                tbody.append(tbodyTd2);
                tbody.append(tbodyTd3);

                tbodyTd1.setAttribute("class", "addedback-tbody-td");
                tbodyTd2.setAttribute("class", "addedback-tbody-td");
                tbodyTd3.setAttribute("class", "addedback-tbody-td");

            }) 

        }
    }

    mediaQuery.addListener(handleMobiletoDesktopChange);
    handleMobiletoDesktopChange(mediaQuery);