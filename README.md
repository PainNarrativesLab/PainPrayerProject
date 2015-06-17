Note: Nothing here is intended to be useful to anyone else, yet.....

# Components
- src


    - lib
        
        - generated-classes: 
            Propel created
        
        - generated-conf: 
            Propel created
        
        - generated-sql: 
            Propel created
        
        - Mailer: 
            Handles mail sending operations
        
        - Matcher: 
            Handles creating partnerships between users
        
        - PainAssess: 
            Handles the questionnaires 
        
            - Display: 
                Generates the form for user
        
            - Process: 
                Backend handling of user responses
        
        - Prayer:
            Handles the prayer assignments
            
            - Assign:
                Creates a prayer assignment
                 
            - Display: 
                Generates the form for user
                    
            - Process: 
                Backend handling of user responses
                    
        - Scheduling: 
            Manages scheduled events and tasks
        
          - States: 
                Handles the current experiment state
        
          - Tasks: 
                Managers for individual scheduled tasks
        
        - filemaster.php: Include in every public facing file
  
  
    - www: 
        Public files
  
        - inc:
      
          - css:
            Stylesheets
      
          - img: 
            Image files
        
          - js: 
            javascript files

- tests
