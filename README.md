# det-ldap
DET LDAP connector for php
## What does this connector do?
This connector provides php integration with the DET's ldap and extended AD servers. Can provide enumeration and user groups to php variables. Probably should be configured for secure ldap soon, but alas
## How to use
- Make sure to change the variable names to reflect the school you are attempting to use with, namely lines Line 12 -> Line 20
- These variables aren't required, and you can remove them, to work across any AD User Group
- This isn't quite complete, and doesn't do very much exception throwing, and allows you to configure it as a template for your own use

## Note on use of it
+ Please note that this application code will only work when ran inside the DET NSW Network, or with a tunnel into that network, this does not make any attempt in order to authenticate with the services outside of the intranet, as such this would be not recommended for resources hosted outside of the network.
+ This software also makes no attempt at load balancing or rate limting and will operate at the speed of the nearest Read Only Domain Controller at the DET location. Please use this wisely.
