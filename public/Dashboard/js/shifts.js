document.addEventListener("DOMContentLoaded", function() {
    var endReadingsInputs = document.querySelectorAll('.end-readings');

    endReadingsInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            calculateDifferenceAndValue(this);
        });
    });

    function calculateDifferenceAndValue(input) {
        var deviceId = input.dataset.deviceId;
        var pricePerLiter = input.dataset.pricePerLiter;
        var endReadings = parseFloat(input.value);
        var startReadingsElement = document.querySelector('#start_readings' + deviceId);

        if (startReadingsElement) {
            var startReadings = parseFloat(startReadingsElement.value);
            var defrance = endReadings - startReadings;
            var value = defrance * pricePerLiter;

            var defranceElement = document.querySelector('#defrance' + deviceId);
            var valueElement = document.querySelector('#value' + deviceId);

            if (defranceElement && valueElement) {
                defranceElement.value = defrance;
                valueElement.value = value;

                updateTotalValues(); // Update total defrance and total value
            }
        }
    }

    function updateTotalValues() { 
        var fuelTypes = {!! json_encode($fuelTypes) !!};
        var totalDefrance = {};
        var totalValue = {};

        var endReadingsInputs = document.querySelectorAll('.end-readings');

        endReadingsInputs.forEach(function(input) {
            var fuelTypeElement = input.closest('tr').querySelector('.fuel-type');
            var defranceElement = document.querySelector('#defrance' + input.dataset.deviceId);
            var valueElement = document.querySelector('#value' + input.dataset.deviceId);

            if (fuelTypeElement && defranceElement && valueElement) {
                var fuelType = fuelTypeElement.dataset.fuelType;
                var defrance = parseFloat(defranceElement.value) || 0;
                var value = parseFloat(valueElement.value) || 0;

                totalDefrance[fuelType] = (totalDefrance[fuelType] || 0) + defrance;
                totalValue[fuelType] = (totalValue[fuelType] || 0) + value;
            }
        });

        // Update total defrance and total value fields for each fuelType
        fuelTypes.forEach(function(fuelType) {
            var totalDefranceElement = document.querySelector('#totalDefrance' + fuelType);
            var totalValueElement = document.querySelector('#totalValue' + fuelType);

            if (totalDefranceElement && totalValueElement) {
                totalDefranceElement.value = totalDefrance[fuelType].toFixed(2);
                totalValueElement.value = totalValue[fuelType].toFixed(2);
            }
        });

        updateTotalValueAfterDeductions();
    },

    function updateTotalValueAfterDeductions() {
        var totalDefranceInputs = document.querySelectorAll('.total-value');
        var totalDefranceSum = 0;
        
        totalDefranceInputs.forEach(function(input) {
            totalDefranceSum += parseFloat(input.value) || 0;
        });

        var expenses = parseFloat(document.getElementById('expenses').value) || 0;
        var tax = parseFloat(document.getElementById('tax').value) || 0;

        var totalValueAfterDeductions = totalDefranceSum - expenses - tax;

        document.getElementById('total_value_after_deductions').value = totalValueAfterDeductions.toFixed(2);
    }
   
  
});
