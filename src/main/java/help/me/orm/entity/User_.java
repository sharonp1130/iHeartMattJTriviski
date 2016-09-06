package help.me.orm.entity;

import javax.annotation.Generated;
import javax.persistence.metamodel.SetAttribute;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="Dali", date="2016-07-29T14:41:50.727-0700")
@StaticMetamodel(User.class)
public class User_ {
	public static volatile SingularAttribute<User, Integer> userId;
	public static volatile SingularAttribute<User, Boolean> isProvider;
	public static volatile SingularAttribute<User, Info> info;
	public static volatile SingularAttribute<User, Settings> settings;
	public static volatile SingularAttribute<User, String> firstName;
	public static volatile SingularAttribute<User, String> lastName;
	public static volatile SingularAttribute<User, String> email;
	public static volatile SetAttribute<User, License> licenses;
	public static volatile SetAttribute<User, Location> locations;
	public static volatile SingularAttribute<User, Long> createdAt;
	public static volatile SingularAttribute<User, Long> updatedAt;
}
