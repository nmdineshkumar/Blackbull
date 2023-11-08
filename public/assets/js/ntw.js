/************************************************************/
function NumToWordsInt(NumIn) {
    /************************************************************
    * Convert Integer Numbers to English Words
    * Using the Single Loop String Triplets Method
    * @Param : {Number}  The number to be converted
    *                    For large numbers use a string
    * @Return: {String}  Wordified Number (Number in English Words)
    * @Author: Mohsen Alyafei 10 July 2019
    * @Notes : Call separately for whole and for fractional parts.
    *          Scale Array may be increased by adding more scale
    *          names if required after Decillion.
    /************************************************************/

    if (NumIn == 0) return "Zero";
    var Ones = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"],
        Tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"],
        Scale = ["", "Thousand", "Million", "Billion", "Trillion", "Quadrillion", "Quintillion", "Sextillion", "Septillion", "Octillion", "Nonillion", "Decillion"],
        N1, N2, Sep, j, i, h, Trplt, tns = "", NumAll = "";
    NumIn += "";                                            // Make NumIn a String
    //----------------- code starts -------------------
    NumIn = "0".repeat(NumIn.length * 2 % 3) + NumIn;       //Create shortest string triplets 0 padded
    j = 0;                                                  //Start with the highest triplet from LH
    for (i = NumIn.length / 3 - 1; i >= 0; i--) {        //Loop thru number of triplets from LH most
        Trplt = NumIn.substring(j, j + 3);                 //Get a triplet number starting from LH
        if (Trplt != "000") {                               //Skip empty trplets
            Sep = Trplt[2] != "0" ? "-" : " ";                  //Dash only for 21 to 99
            N1 = Number(Trplt[0]);                           //Get Hundreds digit
            N2 = Number(Trplt.substr(1));                    //Get 2 lowest digits (00 to 99) 
            tns = N2 > 19 ? Tens[Number(Trplt[1])] + Sep + Ones[Number(Trplt[2])] : Ones[N2];
            NumAll += ((h = N1 > 0 ? Ones[N1] + " Hundred" : "") + " " + tns).trim() + " " + Scale[i] + " ";
        }
        j += 3;                                            //Next lower triplets (move to RH)
    }
    //----------------- code Ends --------------------
    return NumAll.trim();                                   //Return trimming excess spaces if any
}