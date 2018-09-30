#! /bin/pfsh

prefix=/usr/local
exec_prefix=${prefix}

grep solaris.smf.value.gearman /etc/security/auth_attr > /dev/null
if [ $? -ne 0 ]
then
  ed /etc/security/auth_attr > /dev/null <<EOF
a
solaris.smf.value.gearman:::Change Gearman value properties::
solaris.smf.manage.gearman:::Manage Gearman service states::
.
w
q
EOF
  if [ $? -ne 0 ]
  then
    echo "Failed to add authorization definitions"
    exit 1
  fi
fi

grep solaris.smf.manage.gearman /etc/security/prof_attr > /dev/null
if [ $? -ne 0 ]
then
  ed /etc/security/prof_attr > /dev/null <<EOF
a
Gearman Administration::::auths=solaris.smf.manage.gearman,solaris.smf.value.gearman
.
w
q
EOF

  if [ $? -ne 0 ]
  then
    echo "Failed to add profile definitions"
    exit 1
  fi
fi

getent group gearmand > /dev/null
if [ $? -ne 0 ]
then
  groupadd gearmand
  if [ $? -ne 0 ]
  then
    echo "Failed to create group gearmand"
    exit 1
  fi
fi

getent passwd gearmand > /dev/null
if [ $? -ne 0 ]
then
  roleadd -c "Gearman daemon" -d ${prefix}/var -g gearmand \
          -A solaris.smf.value.gearman,solaris.smf.manage.gearman gearmand
  if [ $? -ne 0 ]
  then
    echo "Failed to create role gearmand"
    exit 1
  fi

  mkdir -p ${prefix}/var 
  chown gearmand:gearmand ${prefix}/var
fi

/usr/sbin/install -f /lib/svc/method gearmand
if [ $? -ne 0 ]
then
  echo "Failed to install smf startup script"
  exit 1
fi

/usr/sbin/install -f /var/svc/manifest/application -m 0444 gearmand.xml
if [ $? -ne 0 ]
then
  echo "Failed to install smf definition"
  exit 1
fi

svccfg import /var/svc/manifest/application/gearmand.xml
if [ $? -ne 0 ]
then
  echo "Failed to import smf definition"
  exit 1
fi

