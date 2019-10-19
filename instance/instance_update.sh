echo -e "Instance $1 wird geschlossen"
./instance_kill.sh $1
echo -e "Instance $1 wird gelöscht"
cd instances
rm -r $1
echo -e "Instance $1 wird erstellt"
cd ../
./instance_create.sh $1 $2
