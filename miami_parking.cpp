#include <iostream>
#include <cmath>

using namespace std;

void printReceipt(int totHour, int hourIn, int minIn, int hourOutR, int minOutR, int totChrRec);
void printTicket(int hourIn, int minIn);

int main()
{
    int minIn, hourIn, minOut, hourOut, totHour, totMin, carclass, totCharg, paymt, totChrRec, hourOutR, minOutR;
    char membSt;

    cout << " .----------------. .----------------. .----------------.\n"
"| .--------------. | .--------------. | .--------------. |\n"
"| | ____    ____ | | |   ______     | | |      __      | |\n"
"| ||_   \\  /   _|| | |  |_   __ \\   | | |     /  \\     | |\n"
"| |  |   \\/   |  | | |    | |__) |  | | |    / /\\ \\    | |\n"
"| |  | |\\  /| |  | | |    |  ___/   | | |   / ____ \\   | |\n"
"| | _| |_\\/_| |_ | | |   _| |_      | | | _/ /    \\ \\_ | |\n"
"| ||_____||_____|| | |  |_____|     | | ||____|  |____|| |\n"
"| |              | | |              | | |              | |\n"
"| '--------------' | '--------------' | '--------------' |\n"
" '----------------' '----------------' '----------------' \n";
    cout << "Welcome to the Parking Garage! Please enter your entry hour." << endl;
    cin >> hourIn;
        if (hourIn >= 24 || hourIn < 0)
        {
        cout << "You entered an invalid hour." << endl;
        return 0;
        }
    cout << "Great. Now enter the minute." << endl;
    cin>> minIn;
        if (minIn >= 60 || minIn < 0)
        {
        cout << "You entered an invalid minute." << endl;
        return 0;
        }
    cout << "\nYour ticket is printing now..." << endl;

    printTicket(hourIn, minIn);


    cout << "\nWelcome back. Please enter your exit hour." << endl;
    cin >> hourOut;
        if (hourOut >= 24 || hourOut < 0)
        {
        cout << "\n*****Please see a parking attendant*****" << endl;
        return 0;
        }
    cout << "And now the minute." << endl;
    cin >> minOut;

    if (minOut >= 60 || minOut < 0)
        {
        cout << "\n*****Please see a parking attendant*****" << endl;
        return 0;
        }

    minOutR = minOut;
    hourOutR = hourOut;

    if (hourOut < hourIn)
        hourOut = hourOut + 12;

    if (minOut < minIn)
    {
        minOut = minOut+60;
        hourOut--;
    }

    totMin = minOut - minIn;
    totHour = hourOut - hourIn;
    if (totMin >= 1)
        totHour++;
    cout << "\n\nNow please enter your car class, so that we can calculate your charges.";
    cout << "\n                 1 for Compact or Hybrid/Electric";
    cout << "\n                 2 for Regular or Fullsize";
    cout << "\n                 3 for SUV or Truck\n";
    cin >> carclass;

    switch (carclass)
    {
    case 1:
        totCharg = (1*totHour+5);
        break;
    case 2:
        totCharg = (3*totHour+5);
        break;
    case 3:
        totCharg = (5*totHour+5);
    }

    cout << "Do you have a Park+ Membership card? Y/N" << endl;
    cin >> membSt;

    if (membSt == 'Y')
    {
        totCharg = ((totCharg)-5);
    }
    else if (membSt == 'N')
    {
        cout << "\nYou should consider joining!" << endl;
    }

    cout << "\nYour total is: $" << totCharg << endl;

    totChrRec = totCharg;

    while (totCharg > 0)
    {
        cout << "\nEnter your payment now: ";
        cin >> paymt;
    if (paymt > totCharg)
    {
        totCharg = totCharg - paymt;
        cout << "Your change is: $" << abs(totCharg) << endl;
        break;
    }
    else if (paymt == totCharg)
    {
        cout << "Thank you!";
        break;
    }
    else
        totCharg = totCharg - paymt;
        cout << "\nYour total is now $" << totCharg;
    }

    cout << "\n\nThank you for your payment.\nPlease Take your receipt." << endl;
    cout << "!!!!!!!!!!         GATE UP         !!!!!!!!!!\n\n" << endl;

    printReceipt(totHour, hourIn, minIn, hourOutR, minOutR, totChrRec);

    return 0;
}

void printReceipt (int totHour, int hourIn, int minIn, int hourOutR, int minOutR, int totChrRec)
{
    cout << "_______________________________________________\n"
            "|                                             |\n"
            "|========== MIAMI PARKING AUTHORITY ==========|\n"
            "|             NE 118th St Garage              |\n"
            "|    Entry Time: " << hourIn << ":" << minIn << " :: Exit Time: " << hourOutR << ":" << minOutR << "      |\n"
            "|                                             |\n"
            "|          Total Charges: $" << totChrRec << ".00              |\n"
            "|          Hours Charged: " << totHour << "                  |\n"
            "|                                             |\n"
            "|                                             |\n"
            "|                                             |\n"
            "|        Thank you for parking with us!       |\n"
            "|    Not a Park+ Member? Consider joining!    |\n"
            "|    Enjoy discounts, free days, and more.    |\n"
            "|                                             |\n"
            "|      Questions? Comments? Assistance?       |\n"
            "|             Phone: 303-373-6789             |\n"
            "|             www.MiamiParking.com            |\n"
            "|_____________________________________________|\n";


}

void printTicket (int hourIn, int minIn)
{
    cout << "          __________________________________\n"
            "         /       MIAMI PARKING AUTHORITY    |\n"
            "        / XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX|\n"
            "       /            Ticket #33454           |\n"
            "       |            Time In: " << hourIn << ":" << minIn << "           |\n"
            "       |                                    |\n"
            "       |   ****NO OVERNIGHT PARKING****     |\n"
            "       |____________________________________|\n";


}

