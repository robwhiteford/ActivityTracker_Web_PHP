            function ValidateForm()
            {
                var vTest;
                // Validate weight
                vTest = document.getElementById("Weight").value;
                if (vTest == "") 
                {
                    alert("Please enter a valid weight");
                    document.form.Weight.focus();
                    return(false);
                }
                if (isNaN(vTest)) 
                {
                    alert("Please enter a numeric value for weight");
                    document.form.Weight.focus();
                    return(false);
                }                
                // Validate step count
                vTest = document.getElementById("StepCount").value;
                if (vTest == "") 
                {
                    alert("Please enter a valid step count");
                    document.form.StepCount.focus();
                    return(false);
                }
                if (isNaN(vTest)) 
                {
                    alert("Please enter a numeric value for step count");
                    document.form.StepCount.focus();
                    return(false);
                }
                // Validate distance
                vTest = document.getElementById("Distance").value;
                if (vTest == "") 
                {
                    alert("Please enter a valid distance");
                    document.form.Distance.focus();
                    return(false);
                }
                if (isNaN(vTest)) 
                {
                    alert("Please enter a numeric value for distance");
                    document.form.Distance.focus();
                    return(false);
                }
                // Validate time
                vTest = document.getElementById("TotalTime").value;
                if (vTest == "") 
                {
                    alert("1Please enter a valid time in the format hh:mm:ss");
                    document.form.TotalTime.focus();
                    return(false);
                }
                var regex = new RegExp("([0-5][0-9]):([0-5][0-9]):([0-5][0-9])");
                if (!regex.test(vTest)) 
                {
                    alert("3Please enter a valid time in the format hh:mm:ss");
                    document.form.TotalTime.focus();
                    return(false);
                }
                // Validate average pace
                vTest = document.getElementById("AveragePace").value;
                if (vTest == "") 
                {
                    alert("Please enter a valid average pace");
                    document.form.AveragePace.focus();
                    return(false);
                }
                if (isNaN(vTest)) 
                {
                    alert("Please enter a numeric value for average pace");
                    document.form.AveragePace.focus();
                    return(false);
                }   
                // Validate maximum pace
                vTest = document.getElementById("MaximumPace").value;
                if (vTest == "") 
                {
                    alert("Please enter a valid maximum pace");
                    document.form.MaximumPace.focus();
                    return(false);
                }
                if (isNaN(vTest)) 
                {
                    alert("Please enter a numeric value for maximum pace");
                    document.form.MaximumPace.focus();
                    return(false);
                } 
                // Validate average cadance
                vTest = document.getElementById("AverageCadance").value;
                if (vTest == "") 
                {
                    alert("Please enter a valid average cadance");
                    document.form.AverageCadance.focus();
                    return(false);
                }
                if (isNaN(vTest)) 
                {
                    alert("Please enter a numeric value for average cadance");
                    document.form.AverageCadance.focus();
                    return(false);
                }   
                // Validate maximum cadance
                vTest = document.getElementById("MaximumCadance").value;
                if (vTest == "") 
                {
                    alert("Please enter a valid maximum cadance");
                    document.form.MaximumCadance.focus();
                    return(false);
                }
                if (isNaN(vTest)) 
                {
                    alert("Please enter a numeric value for maximum cadance");
                    document.form.MaximumCadance.focus();
                    return(false);
                } 
                // Validate average stride
                vTest = document.getElementById("AverageStride").value;
                if (vTest == "") 
                {
                    alert("Please enter a valid average stride");
                    document.form.AverageStride.focus();
                    return(false);
                }
                if (isNaN(vTest)) 
                {
                    alert("Please enter a numeric value for average stride");
                    document.form.AverageStride.focus();
                    return(false);
                } 
                // Validate average speed
                vTest = document.getElementById("AverageSpeed").value;
                if (vTest == "") 
                {
                    alert("Please enter a valid average speed");
                    document.form.AverageSpeed.focus();
                    return(false);
                }
                if (isNaN(vTest)) 
                {
                    alert("Please enter a numeric value for average speed");
                    document.form.AverageSpeed.focus();
                    return(false);
                }  
                // Validate calories
                vTest = document.getElementById("Calories").value;
                if (vTest == "") 
                {
                    alert("Please enter a valid calories");
                    document.form.Calories.focus();
                    return(false);
                }
                if (isNaN(vTest)) 
                {
                    alert("Please enter a numeric value for calories");
                    document.form.Calories.focus();
                    return(false);
                }  
                // Validate average heart rate
                vTest = document.getElementById("AverageHeartRate").value;
                if (vTest == "") 
                {
                    alert("Please enter a valid average heart rate");
                    document.form.AverageHeartRate.focus();
                    return(false);
                }
                if (isNaN(vTest)) 
                {
                    alert("Please enter a numeric value for average heart rate");
                    document.form.AverageHeartRate.focus();
                    return(false);
                }
                // Validate maximum heart rate
                vTest = document.getElementById("MaximumHeartRate").value;
                if (vTest == "") 
                {
                    alert("Please enter a valid maximum heart rate");
                    document.form.MaximumHeartRate.focus();
                    return(false);
                }
                if (isNaN(vTest)) 
                {
                    alert("Please enter a numeric value for maximum heart rate");
                    document.form.MaximumHeartRate.focus();
                    return(false);
                } 
                // Validate minimum heart rate
                vTest = document.getElementById("MinimumHeartRate").value;
                if (vTest == "") 
                {
                    alert("Please enter a valid minimum heart rate");
                    document.form.MinimumHeartRate.focus();
                    return(false);
                }
                if (isNaN(vTest)) 
                {
                    alert("Please enter a numeric value for minimum heart rate");
                    document.form.MinimumHeartRate.focus();
                    return(false);
                }                                                                                                                                                    
                return(true);          
            }