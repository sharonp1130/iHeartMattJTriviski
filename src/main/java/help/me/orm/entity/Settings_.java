package help.me.orm.entity;

import java.util.Date;
import javax.annotation.Generated;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="Dali", date="2015-11-27T22:31:41.881-0800")
@StaticMetamodel(Settings.class)
public class Settings_ {
	public static volatile SingularAttribute<Settings, Integer> settingsId;
	public static volatile SingularAttribute<Settings, Date> mondayStart;
	public static volatile SingularAttribute<Settings, Date> mondayEnd;
	public static volatile SingularAttribute<Settings, Date> tuesdayStart;
	public static volatile SingularAttribute<Settings, Date> tuesdayEnd;
	public static volatile SingularAttribute<Settings, Date> wednesdayStart;
	public static volatile SingularAttribute<Settings, Date> wednesdayEnd;
	public static volatile SingularAttribute<Settings, Date> thursdayStart;
	public static volatile SingularAttribute<Settings, Date> thursdayEnd;
	public static volatile SingularAttribute<Settings, Date> fridayStart;
	public static volatile SingularAttribute<Settings, Date> fridayEnd;
	public static volatile SingularAttribute<Settings, Date> saturdayStart;
	public static volatile SingularAttribute<Settings, Date> saturdayEnd;
	public static volatile SingularAttribute<Settings, Date> sundayStart;
	public static volatile SingularAttribute<Settings, Date> sundayEnd;
	public static volatile SingularAttribute<Settings, User> user;
	public static volatile SingularAttribute<Settings, Date> createdAt;
	public static volatile SingularAttribute<Settings, Date> updatedAt;
}
