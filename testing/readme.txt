..:: INSTALLATION DIRECTORIES ::..
-----------------------------------------------------------------
WEBSERVER ROOT  = c:\webserver\
APACHE ROOT     = c:\webserver\apache\
MYSQL ROOT      = c:\webserver\mysql\
PHP ROOT        = c:\webserver\php5\


..:: CONFIG ::..
-----------------------------------------------------------------

--: APACHE :--
conf files
C:\webserver\apache\conf\httpd.conf
C:\webserver\apache\conf\conf.d\00-setup.conf
C:\webserver\apache\conf\conf.d\01-init.conf
C:\webserver\apache\conf\conf.d\05-ebaseloader.conf
C:\webserver\apache\conf\conf.d\ebase.include


--: MYSQL :--
C:\webserver\mysql\program-data\my.ini


--: PHP :--
c:\webserver\php5\php.ini


..:: WINDOWS ENV. VARIABLES ::..
-----------------------------------------------------------------
USER PATH = c:\webserver\apache\
USER PATH = c:\webserver\mysql\
USER PATH = c:\webserver\php5\



ENHANCEMENTS
PROJECT MANAGER
-- Create Projects and generate json files
-- Project Viewer shows project info, db info. versions 

-----------------------------------------------------------------
..:: DOCUMENTATION ::..
-----------------------------------------------------------------

    //  Features:
    - Consistant way to create and clean up local dev environments based on tasks
    - Standard method to directly relate tasks to local env, no more guessing what project a VH is setup for
    - Env is identified by task or by client
    - Standardize task / projet workflow
    - Ensure that DB and files are up to date
    - Clear Logs
    - Clear Cache
    - Restart Apache
    - Add new Server
    - Delete server (Will also clean up http config and logs)
    - Change db that is related to VH
    - Manage databases (Add, Remove, Load SQL, Anonymize)



    // Projects File Structure : X:\
    
    x:\proejcts\{{Client/Project}}
    x:\proejcts\{client||project}}\{client||project}}.sql
    x:\proejcts\{client||project}}\{client||project}}.json

    
    // Default Project
    {client||project}}.sql : is the exported datbase from the client
    {client||project}}.json : contains the following data structure for the project

    Project = {
        "project_name" : {{proper_name}},
        "sql_file" : {{sql_file_name}},
        "sql_file_checksum" : {{sql_file_checksum}}, // can be used to compare and warn when file is out of date
        "document_root" : {{document_root}}
    }

    // Alternate Project uses same properites as other default projects
    {client||project}}_{{alt_identifier}}.sql
    {client||project}}_{{alt_identifier}}.json

   
    // VirtualHost JSON :
    
    ebase_project.json
    Project = {
        "project_name" : {{proper_name}},
        "sql_file" : {{sql_file_name}},
        "sql_file_checksum" : {{sql_file_checksum}}, // can be used to compare and warn when file is out of date
        "sql_load_date" : {{sql_load_date}},
        "task_number" : {{task_number}},
        "task_description" : {{task_desc}},
        "notes" : {{notes}}
    }


    // GENERATED LINK IN WORK ORDER TASK
    This link will be generated when a tak is created. We can pull the task_id, task_title, client from dropdown. DB will have to be manually entered or create a reader to read project folders for available projects.
    http://ebaseloader.ebasefm.com/load?root={{document_root}}&projectfile={{project_json_name}}&taskid={{taskID}}&taskdesc={{task_title}}

    ToDo:


    Enhancements:
    - Launch Sublime Project Folder
    - Log Monitor / Checker
    - Config File Editor for hosts, config, with highligher
    - Update project from trunk
    - Update Env for new Task



    </pre>