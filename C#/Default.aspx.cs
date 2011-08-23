using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Diagnostics;

namespace NHSNumberValidation
{
    public partial class _Default : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            /// The NHSNumbers to check
            string[] NHSNumbers = new string[] { "401023213", "4010232137" };
            /// Loop over all NHSNumbers and check if they are valid
            foreach (string NHSNumber in NHSNumbers)
            {
                Debug.WriteLine("NHS Number Used: " + NHSNumber);

                var validateMe = new NHSNumberValidation();
                validateMe.NHSNumberValdiation(NHSNumber);
                
                if (validateMe.getIsValid().Equals(true))
                {
                    Debug.WriteLine("This is a CORRECT NHS Number");
                }
                else
                {
                    Debug.WriteLine("This is NOT a NHS Number");
                }

            }
        }
    }
}
