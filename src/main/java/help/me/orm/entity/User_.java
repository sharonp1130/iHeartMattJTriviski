package help.me.orm.entity;

import java.util.Date;
import javax.annotation.Generated;
import javax.persistence.metamodel.SetAttribute;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="Dali", date="2015-11-26T18:59:13.240-0800")
@StaticMetamodel(User.class)
public class User_ {
	public static volatile SingularAttribute<User, Integer> userId;
	public static volatile SingularAttribute<User, String> email;
	public static volatile SingularAttribute<User, Date> createdAt;
	public static volatile SingularAttribute<User, Date> updatedAt;
	public static volatile SingularAttribute<User, Info> info;
	public static volatile SingularAttribute<User, Settings> settings;
	public static volatile SetAttribute<User, Location> locations;
	public static volatile SetAttribute<User, License> licenses;
}