<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ICOCategory;

class ICOCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            // Probably a better way to do this.

            $categories =
            [
              ['Alteration of personal data', 'Non-cyber security incidents', 'Alteration of personal data, such as failures to correct incorrect personal information or unauthorised editing'],
              ['Data emailed to incorrect recipient', 'Non-cyber security incidents', 'An Email or Email conversation containing personal data was sent to a recipient who should not have access to the information contained'],
              ['Data of wrong data subject shown in client portal', 'Non-cyber security incidents', 'Data of wrong data subject shown in client portal potentially due to misconfiguration, caching or providing more data than necessary'],
              ['Data posted or faxed to incorrect recipient', 'Non-cyber security incidents', 'Physical copies of data such as letters or faxes sent to incorrect recipients'],
              ['Failure to redact', 'Non-cyber security incidents', 'Privileged information was sent to an individual without removing personal data of others'],
              ['Failure to use bcc', 'Non-cyber security incidents', 'An Email or Email conversation was sent using a method which exposed other intended recipients'],
              ['Incorrect disposal of hardware', 'Non-cyber security incidents', 'Physical equipment such as hard drives or USB sticks were not wiped before being given to recipients with personal data still contained'],
              ['Incorrect disposal of paperwork', 'Non-cyber security incidents', 'Paperwork was not disposed of properly in a manner that allowed unintended audiences to read personal information'],
              ['Loss/theft of device containing personal data', 'Non-cyber security incidents', 'Physical equipment such as hard drives or USB sticks were stolen with personal data still contained'],
              ['Loss/theft of paperwork or data left in insecure location', 'Non-cyber security incidents', 'Physical equipment such as hard drives or USB sticks were stolen with personal data still contained in an insecure location'],
              ['Not Provided', 'Non-cyber security incidents', 'Further information or explanation is not provided'],
              ['Other non-cyber incident', 'Non-cyber security incidents', 'Further information or explanation is not provided'],
              ['Unauthorised access (non-cyber)', 'Non-cyber security incidents', 'Unintended users of the system were able to access systems containing personal information through traditional user interfaces'],
              ['Verbal disclosure of personal data', 'Non-cyber security incidents', 'An individual or individuals was informed of personal information about an individual or individuals verbally such as a phone call or in person'],
              ['Brute Force', 'Cyber security incidents', 'A malicious actor was able to access a system by guessing credentials to privileged systems through repetitive systematic often informed guessing'],
              ['Denial of service', 'Cyber security incidents', 'A malicious actor was able to prevent access to information systems'],
              ['Hardware/software misconfiguration', 'Cyber security incidents', 'A software package or user interface was not configured securely, allowing personal information to be accessed when it should have otherwise been configured to prevent access'],
              ['Malware', 'Cyber security incidents', 'Malicious software was able to access, delete or alter personal information'],
              ['Other cyber incident', 'Cyber security incidents', 'Further information or explanation is not provided'],
              ['Phishing', 'Cyber security incidents', 'A malicious actor was able to steal credentials of privileged users through a phishing campaign'],
              ['Ransomware', 'Cyber security incidents', 'Malicious software was able to access, delete or alter personal information through a ransomware campaign'],
              ['Unauthorised access (cyber)', 'Cyber security incidents', 'A software package or user interface was accessed through malicious exploitation of an information system'],
              ['Cryptographic flaw', 'Non-cyber security incidents', 'A flaw in a cryptographic library, such as unsecure encryption protocols allowed the data to be accessed']
            ];

            for ($x = 0; $x <= (count($categories) - 1); $x++) {
              $category = new ICOCategory;
              $category->category = $categories[$x][0];
              $category->sub_category = $categories[$x][1];
              $category->definition = $categories[$x][2];
              $category->save();
            }
    }
}
