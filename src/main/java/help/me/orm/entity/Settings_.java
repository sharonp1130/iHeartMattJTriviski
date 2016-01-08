package help.me.orm.entity;

import java.sql.Time;
import java.util.Date;
import javax.annotation.Generated;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="Dali", date="2016-01-07T20:30:30.640-0800")
@StaticMetamodel(Settings.class)
public class Settings_ {
	public static volatile SingularAttribute<Settings, Integer> settingsId;
	public static volatile SingularAttribute<Settings, User> user;
	public static volatile SingularAttribute<Settings, Date> createdAt;
	public static volatile SingularAttribute<Settings, Date> updatedAt;
	public static volatile SingularAttribute<Settings, Time> mondayStart;
	public static volatile SingularAttribute<Settings, Time> mondayEnd;
	public static volatile SingularAttribute<Settings, Time> tuesdayStart;
	public static volatile SingularAttribute<Settings, Time> tuesdayEnd;
	public static volatile SingularAttribute<Settings, Time> wednesdayStart;
	public static volatile SingularAttribute<Settings, Time> wednesdayEnd;
	public static volatile SingularAttribute<Settings, Time> thursdayStart;
	public static volatile SingularAttribute<Settings, Time> thursdayEnd;
	public static volatile SingularAttribute<Settings, Time> fridayStart;
	public static volatile SingularAttribute<Settings, Time> fridayEnd;
	public static volatile SingularAttribute<Settings, Time> saturdayStart;
	public static volatile SingularAttribute<Settings, Time> saturdayEnd;
	public static volatile SingularAttribute<Settings, Time> sundayStart;
	public static volatile SingularAttribute<Settings, Time> sundayEnd;
}
